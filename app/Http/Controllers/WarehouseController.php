<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    // Display a list of warehouses
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('warehouses.index', compact('warehouses'));
    }

    // Show the form for creating a new warehouse
    public function create()
    {
        return view('warehouses.add');
    }

    // Store a newly created warehouse
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'location' => 'required',
            // other fields as necessary
        ]);

        Warehouse::create($validatedData);
        return redirect()->route('warehouses.index');
    }

    // Show the form for editing the specified warehouse
    public function edit(Warehouse $warehouse)
    {
        return view('warehouses.edit', compact('warehouse'));
    }

    // Update the specified warehouse
    public function update(Request $request, Warehouse $warehouse)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'location' => 'required',
            // other fields as necessary
        ]);

        $warehouse->update($validatedData);
        return redirect()->route('warehouses.index');
    }

    // Remove the specified warehouse
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return redirect()->route('warehouses.index');
    }
}
