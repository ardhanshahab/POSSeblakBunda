<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\makanan;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class makananController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
     /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get posts
        $posts = makanan::latest()->paginate(5);

        //render view with posts
        return view('makanan.index', compact('posts'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'foto'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama_makanan'     => 'required|min:5',
            'harga'     => 'required|min:1',
            'keterangan'   => 'required|min:10'
        ]);

        //upload image
        $image = $request->file('foto');
        $nama_makanan = $request->nama_makanan;
        $image->storeAs('public/posts', $image->hashName());
        $stok = '0';
        $status = 'Kosong';
        //create post
            makanan::create([
            'foto'     => $image->hashName(),
            'nama_makanan'     => $request->nama_makanan,
            'keterangan'     => $request->keterangan,
            'harga'   => $request->harga,
            'stok'   => $stok,
            'status'   => $status,
        ]);

        //redirect to index
        return redirect()->route('makanan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id)
    {
        //get post by ID
        $post = Makanan::findOrFail($id);

        //return post as JSON response
        return response()->json(['success' => true, 'data' => $post]);
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
        $post =makanan::findOrFail($id);

        //render view with post
        return view('makanan.edit', compact('post'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'foto'     => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama_makanan'     => 'required|min:5',
            'harga'     => 'required|min:1',
            'stok'     => 'required|min:1',
            'status'     => 'required|min:1',
            'keterangan'   => 'required|min:10'
        ]);

        //get post by ID
        $post =makanan::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('foto')) {

            //upload new image
            $image = $request->file('foto');
            $image->storeAs('public/posts', $image->hashName());

            //delete old image
            Storage::delete('public/posts/'.$post->image);

            //update post with new image
            $post->update([
            'foto'     => $image->hashName(),
            'nama_makanan'     => $request->nama_makanan,
            'keterangan'     => $request->keterangan,
            'harga'   => $request->harga,
            'stok'   => $request->stok,
            'status'   => $request->status,
            ]);

        } else {
            //update post without image
            $post->update([
            'nama_makanan'     => $request->nama_makanan,
            'keterangan'     => $request->keterangan,
            'harga'   => $request->harga,
            'stok'   => $request->stok,
            'status'   => $request->status,
            ]);
        }

        //redirect to index
        return redirect()->route('makanan.index')->with(['success' => 'Data Berhasil Diubah!']);
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
        $post =makanan::findOrFail($id);

        //delete image
        Storage::delete('public/posts/'. $post->image);

        //delete post
        $post->delete();

        //redirect to index
        return redirect()->route('makanan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}


