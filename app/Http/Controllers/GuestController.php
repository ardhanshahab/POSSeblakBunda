<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        return view('welcome', compact('menu'));
    }
}
