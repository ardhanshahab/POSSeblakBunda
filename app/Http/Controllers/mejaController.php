<?php

namespace App\Http\Controllers;

use App\Models\meja;
use App\Models\order;
use Illuminate\Http\Request;
use App\Models\produk;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class mejaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        return view('meja.index');
    }

    public function getMeja()
    {
         $posts = meja::get();

         return response()->json([
            'success' => true,
            'message' => 'List meja',
            'data' => $posts,
        ]);
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('meja.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'no_meja'     => 'required|min:1',
        ]);

        meja::create([
            'no_meja'     => $request->no_meja,
            'status'     => "Kosong",
        ]);

        return redirect()->route('meja.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get post by ID
        $post = meja::findOrFail($id);

        //render view with post
        return view('meja.show', compact('post'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get post by ID
        $post = meja::findOrFail($id);

        //render view with post
        return view('meja.edit', compact('post'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status'     => 'required|min:1',
        ]);

        $post = meja::findOrFail($id);

            $post->update([
                'status'     => $request->status,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil diupdate',
                'data' => $post,
            ]);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $post = meja::findOrFail($id);

        //delete post
        $post->delete();

        //redirect to index
        return redirect()->route('meja.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function updateMeja(Request $request, $id)
    {
        $this->validate($request, [
            'status'     => 'required|min:1',
        ]);

        $post = meja::findOrFail($id);

            $post->update([
                'status'     => $request->status,
            ]);

                // Set flash message
         // Temukan pesanan berdasarkan ID
         $order = Order::with('fcfs')->findOrFail($request->order_id);
        //  dd($request->all());

         // Perbarui status pesanan
         $order->status = 'Kosongkan Meja';
         $order->save();

        return redirect()->back();
    }
}
