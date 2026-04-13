<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|unique:products,id',
            'category_id' => 'required|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0'
        ]);

        return Product::create($request->all());
    }

    public function show(Request $request, Product $product) 
    {
        $staff = $request->user();
        $store_id = $staff->store_id;

        $data = DB::table('products')
            ->join('inventories', 'products.product_id', '=', 'inventories.product_id')
            ->where('products.product_id', $product->product_id) 
            ->where('inventories.store_id', $store_id)
            ->select(
                'products.product_id as id', 
                'products.product_name as nombre', 
                'products.product_price as price',
                'inventories.quantity as stock'
            )
            ->first();

        if (!$data) {
            return response()->json([
                'message' => 'Producto sin existencias en esta tienda',
            ], 404);
        }

        return response()->json($data);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_id' => 'sometimes|required|unique:products,id',
            'category_id' => 'sometimes|required|exists:categories,id',
            'product_name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|required|numeric|min:0'
        ]);

        $product->update($request->all());
        return $product;
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

}
