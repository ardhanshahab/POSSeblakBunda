<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AdminDashboardController extends Controller
{
    public function adminIndex()
    {
        $users = User::latest()->paginate(10);
        if (request('search')) {
            $users = User::latest()->search()->paginate(10);
        }
        return view('admin.index', compact('users'));
    }

    public function adminCreate()
    {
        return view('admin.create');
    }

    public function adminStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'profile_image' => 'image|mimes:jpg,png|max:2048',
        ]);

        if ($request->file('profile_image')) {
            $fileImage = hexdec(uniqid()) . '.' . $request->profile_image->extension();
            Image::make($request->file('profile_image'))->resize(100,100)->save('assets/images/profile/' . $fileImage);
            $profileImage = 'assets/images/profile/' . $fileImage;

            $data = new User;
            $data->name = $request->name;
            $data->username = Str::lower($request->username);
            $data->password = bcrypt($request->password);
            $data->profile_image = $profileImage;
            $data->role = $request->role;
            $data->save();
        } else {
            $data = new User;
            $data->name = $request->name;
            $data->username = Str::lower($request->username);
            $data->password = bcrypt($request->password);
            $data->role = $request->role;
            $data->save();
        }
        
        return redirect()->route('admin.index')->with('success', 'User created successfully');
    }

    public function adminEdit($id)
    {
        $users = User::find($id);
        return view('admin.edit', compact('users'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'username' => 'required',
            'password' => 'required',
        ]);

        $update = User::find($id);
        $update->name = $request->name;
        $update->username = Str::lower($request->username);
        $update->password = bcrypt($request->password);
        $update->role = $request->role;
        $update->update();

        return redirect()->route('admin.index')->with('success', 'User updated successfully');
    }

    public function adminDelete($id)
    {
        $delete = User::find($id)->delete();
        return back()->with('danger', 'User deleted successfully');
    }
}
