<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Store;
use App\Models\Product;
use App\Models\Inventory;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        $stores = Store::all();
        $products = Product::all();

        $inventoryData = [];

        foreach ($stores as $store) {
            foreach ($products as $product) {
                $inventoryData[] = [
                    'store_id'   => $store->id,
                    'product_id' => $product->product_id,  // importante cambiamos a     product_id
                    'quantity'   => rand(5, 40),   
                ];
            }
        }

        // Upsert para evitar duplicados y ser más rápido
        Inventory::upsert(
            $inventoryData,
            ['store_id', 'product_id'],   // unique keys
            ['quantity']                  // campos a actualizar si ya existe
        );
    }
}
