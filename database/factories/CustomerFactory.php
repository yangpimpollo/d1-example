<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    public function definition(): array
    {
        $fake = fake('es_ES');

        $gender = $fake->randomElement(['male', 'female']);

        return [
            'dni'       => $fake->dni(),                              // fake()->unique()->regexify('[0-9]{8}'),
            'firstname' => $fake->firstName($gender),
            'lastname'  => $fake->lastName() . ' ' . $fake->lastName(),
            'birthdate' => $fake->date('Y-m-d', '-18 years'),
            'gender'    => $gender === 'male' ? 'male' : 'female',
            'email'     => $fake->unique()->safeEmail(),
            'phone'     => $fake->phoneNumber(),
            'address'   => $fake->streetAddress(),
            'city'      => $fake->city(),
            'state'     => $fake->state(),
        ];
    }
}
