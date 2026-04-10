<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Store;
use Illuminate\Support\Str;


class StaffFactory extends Factory
{
    public function definition(): array
    {
        $fake = fake('es_ES');
        $storeIds = Store::pluck('id')->all();

        $gender = $fake->randomElement(['male', 'female']);

        return [
            'dni'       => $fake->dni(),                              
            'firstname' => $fake->firstName($gender),
            'lastname'  => $fake->lastName() . ' ' . $fake->lastName(),
            'birthdate' => $fake->date('Y-m-d', '-18 years'),
            'gender'    => $gender === 'male' ? 'male' : 'female',
            'email'     => $fake->unique()->safeEmail(),
            'phone'     => $fake->phoneNumber(),
            'address'   => $fake->streetAddress(),
            'store_id'  => $fake->randomElement($storeIds),
            'role'      => $fake->randomElement(['manager', 'sales_staff']),
            'password'  => Hash::make('123')
        ];
    }
}
