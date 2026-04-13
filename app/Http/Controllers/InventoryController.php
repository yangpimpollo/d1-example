<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $staff = $request->user();
        $store_id = $staff->store_id;

        return DB::table('inventories')
            ->join('products', 'inventories.product_id', '=', 'products.product_id')
            ->where('inventories.store_id', $store_id)
            ->select(
                'inventories.product_id', 
                'products.product_name', 
                'inventories.quantity'
            )->get();
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

    public function update(Request $request, $product_id)
    {
        $staff = $request->user();
        $store_id = $staff->store_id;

        // Validamos que envíen la cantidad
        $request->validate([ 'quantity' => 'required|integer|min:0' ]);

        // Buscamos el registro específico de TU tienda para ESE producto
        $inventory = Inventory::where('store_id', $store_id)
                            ->where('product_id', $product_id)
                            ->firstOrFail();

        // Actualizamos la cantidad
        $inventory->update([
            'quantity' => $request->quantity
        ]);

        return response()->json([
            'message' => "Stock de $product_id actualizado para tu tienda.",
            'inventory' => $inventory
        ]);
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return response()->json(['message' => 'Inventory deleted successfully'], 204);
    }
}
