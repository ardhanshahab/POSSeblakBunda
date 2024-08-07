<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topping;

class ToppingController extends Controller
{
    public function index()
    {
        $toppings = Topping::all();
        return view('toppings.index', compact('toppings'));
    }

    public function create()
    {
        return view('toppings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'price' => 'required|numeric',
        ]);

        Topping::create($request->all());

        return redirect()->route('toppings.index')->with('success', 'Topping created successfully.');
    }

    public function edit(Topping $topping)
    {
        return view('toppings.edit', compact('topping'));
    }

    public function update(Request $request, Topping $topping)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'price' => 'required|numeric',
        ]);

        $topping->update($request->all());

        return redirect()->route('toppings.index')->with('success', 'Topping updated successfully.');
    }

    public function destroy(Topping $topping)
    {
        $topping->delete();

        return redirect()->route('toppings.index')->with('success', 'Topping deleted successfully.');
    }
}
