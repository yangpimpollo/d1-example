<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id|digits:8',
            'staff_id' => 'required|exists:staff,id|digits:8',
            'store_id' => 'required|exists:stores,id',
            'order_date' => 'required|date'
        ]);

        return Order::create($request->all());
    }

    public function show(Order $order)
    {
        return $order;
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id' => 'sometimes|required|exists:customers,id',
            'staff_id' => 'sometimes|required|exists:staff,id',
            'store_id' => 'sometimes|required|exists:stores,id',
            'order_date' => 'sometimes|required|date'
        ]);

        $order->update($request->all());
        return $order;
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully'], 204);
    }
}
