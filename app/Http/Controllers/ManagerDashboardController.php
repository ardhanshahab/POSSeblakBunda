<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Menu;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\File;

class ManagerDashboardController extends Controller
{
    public function managerIndex()
    {
        $menus = Menu::orderBy('menu_name', 'ASC')->paginate(10);
        if (request('search')) {
            $menus = Menu::latest()->search()->paginate(10);
        }
        return view('manager.menu.index', compact('menus'));
    }

    public function managerCreate()
    {
        return view('manager.menu.create');
    }

    public function managerStore(Request $request)
    {
        $validated = $request->validate([
            'menu_name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'stock' => 'required|numeric',
            'foto' => 'file|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file foto
        ]);
        // dd($validated);

        // Simpan foto yang diunggah
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/menu_images', $imageName);
        }

        $data = new Menu;
        $data->menu_name = $request->menu_name;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->stock = $request->stock;
        $data->foto = $imageName ?? null; // Simpan nama file foto ke database jika foto diunggah
        $data->save();

        return redirect()->route('manager.index')->with('success', 'Menu created successfully');
    }

    public function managerEdit($id)
    {
        $menus = Menu::find($id);
        return view('manager.menu.edit', compact('menus'));
    }

    public function managerUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'menu_name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'stock' => 'required|numeric',
        ]);

        $update = Menu::find($id);
        $update->menu_name = $request->menu_name;
        $update->price = $request->price;
        $update->description = $request->description;
        $update->stock = $request->stock;
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($update->foto) {
                $fotoPath = public_path('public/menu_images/' . $update->foto);
                if (file_exists($fotoPath)) {
                    unlink($fotoPath);
                }
            }
            // Upload foto baru
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->storeAs('public/menu_images', $fotoName);
            $update->foto = $fotoName;
        }
        $update->update();

        return redirect()->route('manager.index')->with('success', 'Menu updated successfully');
    }


    public function managerDelete($id)
    {
        $menu = Menu::find($id);
        if ($menu) {
            // Hapus foto dari folder public/menu_images jika ada
            if ($menu->foto && file_exists(public_path('menu_images/' . $menu->foto))) {
                unlink(public_path('menu_images/' . $menu->foto));
            }

            // Hapus record dari database
            $menu->delete();

            return redirect()->route('manager.index')->with('success', 'Menu deleted successfully');
        } else {
            return redirect()->route('manager.index')->with('danger', 'Menu not found');
        }
    }

    public function managerReport(Request $request)
    {
        $reports = Transaction::latest()->paginate(10);

        if ($request['date_1'] || $request['date_2']) {
            $reports = Transaction::whereBetween('created_at', [$request['date_1'], $request['date_2']])
            ->paginate(10)->withQueryString();
        }

        Session::put('transactions', $reports);

        if (request('search')) {
            $reports = Transaction::latest()->search()->paginate(10);
        }
        return view('manager.report.index', compact('reports'));
    }

    public function exportPDF(Request $request)
    {
        $employee = auth()->user()->name;
        $role = auth()->user()->role;
        $data_transactions = Session::get('transactions');

        if ($request['all_data'] == true) {
            $data_transactions = Transaction::all();
        }

        $data = [
            'employee' => $employee,
            'role' => $role,
            'transactions' => $data_transactions,
        ];

        $pdf = PDF::loadView('manager.report.pdf-report', $data);
        return $pdf->download(Str::random(20) . '.pdf');
    }
}
