<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KasirDashboardController extends Controller
{
    public function kasirIndex()
    {
        $transactions = Transaction::latest()->paginate(5);
        if (request('search')) {
            $transactions = Transaction::latest()->search()->paginate(10);
        }
        return view('kasir.index', compact('transactions'));
    }

    public function kasirCreate()
    {
        $menus = Menu::orderBy('menu_name', 'ASC')->get();
        return view('kasir.create', compact('menus'));
    }

    public function kasirStore(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required',
            'menu_name' => 'required',
            'qty' => 'required|numeric',
        ]);

        $getMenu = DB::table('menus')->where('menu_name', $request->menu_name)->first();
        $getTotal = $getMenu->price * $request->qty;
        $updateStock = $getMenu->stock - $request->qty;

        if ($getMenu->stock < $request->qty) {
            return back()->with('danger', 'Order cannot be more than the menu stock');
        } else {
            $data = new Transaction;
            $data->customer_name = $request->customer_name;
            $data->menu_name = $request->menu_name;
            $data->qty = $request->qty;
            $data->total = $getTotal;
            $data->employee_name = Auth::user()->name;
            $data->save();

            $updateMenu = Menu::where('menu_name', $request->menu_name)
                ->update(['stock' => $updateStock]);

            return redirect()->route('kasir.index')->with('success', 'Transaction successfully created');
        }
    }

    public function kasirEdit($id)
    {
        $transactions = Transaction::find($id);
        $menus = Menu::orderBy('menu_name', 'ASC')->pluck('menu_name');
        return view('kasir.edit', [
            'transactions' => $transactions,
            'menus' => $menus,
        ]);
    }

    public function kasirUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_name' => 'required',
            'menu_name' => 'required',
            'qty' => 'required|numeric',
        ]);

        $getMenu = DB::table('menus')->where('menu_name', $request->menu_name)->first();
        $getTotal = $getMenu->price * $request->qty;

        if ($request->qty < $request->old_qty) {
            $calcQty1 = $request->old_qty - $request->qty;
            $updateStock1 = $getMenu->stock + $calcQty1;

            if ($getMenu->stock < $request->qty) {
                return back()->with('danger', 'Order cannot be more than the menu stock');
            } else {
                $data = Transaction::find($id);
                $data->customer_name = $request->customer_name;
                $data->menu_name = $request->menu_name;
                $data->qty = $request->qty;
                $data->total = $getTotal;
                $data->employee_name = Auth::user()->name;
                $data->update();

                $updateMenu = Menu::where('menu_name', $request->menu_name)
                    ->update(['stock' => $updateStock1]);

                return redirect()->route('kasir.index')->with('success', 'Transaction successfully updated');
            }
        } else {
            $calcQty2 = $request->qty - $request->old_qty;
            $updateStock2 = $getMenu->stock - $calcQty2;

            if ($getMenu->stock < $request->qty) {
                return back()->with('danger', 'Order cannot be more than the menu stock');
            } else {
                $data = Transaction::find($id);
                $data->customer_name = $request->customer_name;
                $data->menu_name = $request->menu_name;
                $data->qty = $request->qty;
                $data->total = $getTotal;
                $data->employee_name = Auth::user()->name;
                $data->update();

                $updateMenu = Menu::where('menu_name', $request->menu_name)
                    ->update(['stock' => $updateStock2]);

                return redirect()->route('kasir.index')->with('success', 'Transaction successfully updated');
            }
        }
    }

    public function kasirDelete($id)
    {
        Transaction::find($id)->delete();
        return back()->with('danger', 'Transaction successfully deleted');
    }

    public function cariMenu(Request $request)
    {
        $menu = Menu::where('menu_name', 'LIKE', '%' . $request->menu_name . '%')->firstOrFail();
        return $menu;
    }
}
