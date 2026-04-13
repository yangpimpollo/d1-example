<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        return Inventory::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'store_id' => 'required|exists:stores,id',
            'quantity' => 'required|integer|min:0'
        ]);

        return Inventory::create($request->all());
    }

    public function show(Inventory $inventory)
    {
        return $inventory;
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'product_id' => 'sometimes|required|exists:products,id',
            'store_id' => 'sometimes|required|exists:stores,id',
            'quantity' => 'sometimes|required|integer|min:0'
        ]);

        $inventory->update($request->all());
        return $inventory;
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return response()->json(['message' => 'Inventory deleted successfully'], 204);
    }
}
