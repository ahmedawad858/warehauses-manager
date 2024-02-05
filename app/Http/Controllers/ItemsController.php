<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemsController extends Controller
{
    // Display a list of items
    public function index(Request $request)
    {
        $query = Item::query();
        $warehouse_id = -1;
        if ($request->has('warehouse') && !empty($request->warehouse) ) {
            $query->where('warehouse_id', $request->warehouse);
            $warehouse_id   = $request->warehouse;
        }
        $keyword = "";
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
            $keyword = $request->search;
        }
        $query->where("quantity",">",0);
        $warehouses = Warehouse::all();
        $items = $query->get();
        return view('items.index', compact('items', 'warehouses',"warehouse_id","keyword"));
    }

    // Show the form for creating a new item
    public function create()
    {
        $warehouses = Warehouse::all();
        return view('items.create',compact("warehouses"));
    }

    // Store a newly created item
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'warehouse_id' => 'required|exists:warehouses,id',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048', // Validate image

        ]);
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }
        Item::create($validatedData);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    // Show the form for editing the specified item
    public function edit(Item $item)
    {
        $warehouses = Warehouse::all();

        return view('items.edit', compact('item','warehouses'));
    }

    // Update the specified item
    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'warehouse_id' => 'required|exists:warehouses,id',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048', // Validate image

        ]);
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('images', 'public');
            // Delete old image if necessary
            if ($item->image) {
                Storage::delete($item->image);
            }
        }
        $item->update($validatedData);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    // Remove the specified item
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index');
    }


    public function show(Item $item)
    {
        // Load the warehouse associated with the item
        $item->load('warehouse');

        // Calculate the total quantity of pending transactions
        $pendingQuantity = Transaction::where('item_id', $item->id)
            ->where('status', 'pending')
            ->sum('quantity');

        return view('items.show', compact('item', 'pendingQuantity'));
    }
}
