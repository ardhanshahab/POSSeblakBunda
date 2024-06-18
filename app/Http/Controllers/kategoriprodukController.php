<?php

namespace App\Http\Controllers;

use App\Models\kategoriproduk;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
class kategoriprodukController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        return view('kategoriproduk.index');
    }

    public function getKategoriProduk()
    {
         $posts = kategoriproduk::get();

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
        return view('kategoriproduk.create');
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
            'nama_kategori'     => 'required|min:1',
        ]);

        kategoriproduk::create([
            'nama_kategori'     => $request->nama_kategori,
        ]);

        return redirect()->route('kategoriproduk.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $post = kategoriproduk::findOrFail($id);

        //render view with post
        return view('kategoriproduk.show', compact('post'));
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
        $post = kategoriproduk::findOrFail($id);

        //render view with post
        return view('kategoriproduk.edit', compact('post'));
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
            'nama_kategori'     => 'required|min:1',
        ]);

        $post = kategoriproduk::findOrFail($id);

            $post->update([
                'nama_kategori'     => $request->nama_kategori,
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
        $post = kategoriproduk::findOrFail($id);

        //delete image
        // Storage::delete('public/posts/'. $post->image);

        //delete post
        $post->delete();

        //redirect to index
        return redirect()->route('kategoriproduk.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
