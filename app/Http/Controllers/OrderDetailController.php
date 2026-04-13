<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        return OrderDetail::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $subTotal = $product->price * $request->quantity;

        $orderDetail = OrderDetail::create([
            'order_id'   => $request->order_id,
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity,
            'sub_total'  => $subTotal,
        ]);

        return response()->json([
            'message' => 'Detalle de orden creado correctamente',
            'data'    => $orderDetail
        ], 201);
    }

    public function show(OrderDetail $orderDetail)
    {
        return $orderDetail;
    }

    public function update(Request $request, OrderDetail $orderDetail)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($orderDetail->product_id);

        $newSubTotal = $product->price * $request->quantity;

        $orderDetail->update([
            'quantity'  => $request->quantity,
            'sub_total' => $newSubTotal,
        ]);

        return response()->json([
            'message' => 'Detalle actualizado correctamente',
            'data'    => $orderDetail
        ]);
    }

    public function destroy(OrderDetail $orderDetail)
    {
        $orderDetail->delete();
        return response()->json(['message' => 'Order detail deleted successfully'], 204);
    }
}
