<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Customer;
use App\Models\Store;
use App\Models\Staff;


class OrderFactory extends Factory
{
    public function definition(): array
    {
        
        $customerIds = Customer::pluck('dni')->all();
        $randomStaff = Staff::inRandomOrder()->first();
        $storeId = $randomStaff->store_id;
        $staffDni = $randomStaff->dni;



        return [
            'order_id' => $this->faker->unique()->bothify('B0##-00#####'),
            'order_date' => $this->faker->date(),
            'customer_id' => $this->faker->randomElement($customerIds),
            'store_id' => $storeId,
            'staff_id' => $staffDni,
        ];
    }
}
