<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Order;
use App\Models\Product;


class OrderDetailFactory extends Factory
{
    public function definition(): array
    {
        $orderIds = Order::pluck('order_id')->all();
        $all_productIds = Product::pluck('product_id')->all();
        $productId = $this->faker->randomElement($all_productIds);
        $quantity = $this->faker->numberBetween(1, 10);
        $productPrice = Product::where('product_id', $productId)->value('product_price');
        $subTotal = $quantity * $productPrice;

        return [
            'order_id' => $this->faker->randomElement($orderIds),
            'product_id' => $productId,
            'quantity' => $quantity,
            'sub_total' => $subTotal,
        ];
    }
}
