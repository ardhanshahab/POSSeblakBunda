<?php

namespace App\Http\Controllers;

use App\Models\kategoriproduk;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class produkController extends Controller
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
        $posts = kategoriproduk::get();
        return view('produk.index', compact('posts'));
    }

    public function getProduk()
    {
         $posts = produk::get();

         return response()->json([
            'success' => true,
            'message' => 'List Peserta',
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
        return view('produk.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            // Validate form
            $this->validate($request, [
                'image'           => 'image|mimes:jpeg,jpg,png|max:2048',
                'nama_produk'     => 'required|min:1',
                'kategori_produk' => 'required|min:1',
                'harga'           => 'required|numeric|min:1',
                // 'quantity'           => 'required|numeric',
                'deskripsi'       => 'required|min:1'
            ]);

            // Upload image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            // Create product
            Produk::create([
                'image'           => $image->hashName(),
                'nama_produk'     => $request->nama_produk,
                'kategori_produk' => $request->kategori_produk,
                'harga'           => $request->harga,
                'deskripsi'       => $request->deskripsi,
                // 'quantity'       => $request->quantity
            ]);

            // Redirect to index
            return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, redirect kembali dengan pesan error
        dd($e);

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
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
        $post = produk::findOrFail($id);

        //render view with post
        return view('produk.show', compact('post'));
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
        $post = produk::findOrFail($id);

        //render view with post
        return view('produk.edit', compact('post'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        // dd($request->all());
        //validate form
        $this->validate($request, [
            'nama_produk'     => 'required|min:1',
            'kategori_produk_edit' => 'required|min:1',
            'harga'           => 'required|numeric|min:1',
            // 'quantity'           => 'required|numeric',
            'deskripsi'       => 'required|min:1'
        ]);

        //get post by ID
        $post = produk::findOrFail($request->id_produk);

            //update post without image
            $post->update([
                'nama_produk'     => $request->nama_produk,
                'kategori_produk' => $request->kategori_produk_edit,
                'harga'           => $request->harga,
                'deskripsi'       => $request->deskripsi,
                // 'quantity'       => $request->quantity
            ]);
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Data Berhasil diupdate',
        //     'data' => $post,
        // ]);

        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Diupdate!']);

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
        $post = produk::findOrFail($id);

        //delete image
        Storage::delete('public/posts/'. $post->image);

        //delete post
        $post->delete();

        //redirect to index
        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
