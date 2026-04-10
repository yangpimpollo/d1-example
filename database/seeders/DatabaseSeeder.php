<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            CustomerSeeder::class,
            StoreSeeder::class,

            // ProductSeeder::class, --- IGNORE ---

            InventorySeeder::class,  // ← después de stores y products
            StaffSeeder::class,      // ← después de stores
            OrderSeeder::class,      // ← después de customers, stores y staffs
            OrderDetailSeeder::class, // ← después de orders y products
        ]);
    }
}
