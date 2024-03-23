<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profileIndex()
    {
        if (Auth::user() == true) {
            $profile = User::find(Auth::user()->id);
        }
        return view('profile.index', compact('profile'));
    }

    public function profileUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'profile_image' => 'image|mimes:jpg,png|max:2048',
        ]);

        if ($request->file('profile_image') && $request->old_image) {
            $oldImage = $request->old_image;
            unlink($oldImage);

            $fileImage = hexdec(uniqid()) . '.' . $request->profile_image->extension();
            Image::make($request->file('profile_image'))->resize(100,100)->save('assets/images/profile/' . $fileImage);
            $profileImage = 'assets/images/profile/' . $fileImage;

            $update = User::find($id);
            $update->name = $request->name;
            $update->username = $request->username;
            $update->profile_image = $profileImage;
            $update->update();
        } elseif ($request->file('profile_image') && $request->old_image == null) {
            $fileImage = hexdec(uniqid()) . '.' . $request->profile_image->extension();
            Image::make($request->file('profile_image'))->resize(100,100)->save('assets/images/profile/' . $fileImage);
            $profileImage = 'assets/images/profile/' . $fileImage;

            $update = User::find($id);
            $update->name = $request->name;
            $update->username = $request->username;
            $update->profile_image = $profileImage;
            $update->update();
        } else {
            $update = User::find($id);
            $update->name = $request->name;
            $update->username = $request->username;
            $update->update();
        }

        return back()->with('success', 'Profile updated successfully');
    }

    public function changePassIndex()
    {
        return view('profile.change-password');
    }

    public function changePassUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashPassword = auth()->user()->password;
        if (Hash::check($request->current_password, $hashPassword)) {
            $user = User::find(auth()->id());
            $user->password = bcrypt($request->password);
            $user->save();
            return back()->with('success', 'Password changed successfully');
        } else {
            return back()->with('danger', 'Current password is invalid');
        }
    }

    public function removePhoto($id)
    {
        if (auth()->user()->profile_image == null) {
            return back()->with('danger', "You don't have a photo to delete");
        } else {
            $user = User::findOrFail($id);
            $image = $user->profile_image;
            unlink($image);
            $user->profile_image = null;
            $user->save();
            return back()->with('success', 'Photo profile successfully deleted');
        }
    }
}
