<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Store>
 */
class StoreFactory extends Factory
{
    private function generatePizzaStoreName($fake): string
    {
        $cadenaBase = $fake->randomElement([ 'Pizza', 'Pizzería', 'La Pizza', 'Pizza House',
                                             'Pizza World', 'Bella Pizza', 'Roma Pizza', 'Napoli',
                                             'Donatello', 'Pizza Express', 'Pizza King', 'Pizza Master',
                                             'Original Pizza', 'Come Pizza', 'Quiero Pizza', 'Super Queso',
                                             'pizza al Paso', 'Pizza y Algo Más', 'Pizza del Barrio',
                                             'Pizza de la Esquina', 'Pizza Total', 'la oveja Negra']);

        $sufijos = [
            '', 
            ' ' . $fake->lastName(),
            ' ' . $fake->city(),
            ' ' . $fake->randomElement(['Express', 'Premium', 'Gourmet', '24h', 'Fresh']),
            ' ' . $fake->randomElement(['& Grill', '& Pasta', 'Italiana']),
            ' #' . $fake->randomNumber(2, true),   // Ej: Pizza Roma #12
        ];

        $nombre = $cadenaBase . $fake->randomElement($sufijos);

        // A veces agregar "La" al principio para que suene más español 30% de las veces
        if ($fake->boolean(30)) { $nombre = 'La ' . $nombre; }

        return $nombre;
    }

    public function definition(): array
    {
        $fake = fake('es_ES');                       // $this->faker->unique()->lexify('??????');   ynewpd
        
        return [
            'id' => $fake->unique()->regexify('[A-Z]{2}-[A-Z]{3}-[0-9]{2}'),  
            'store_name' => $this->generatePizzaStoreName($fake),
            'address' => $fake->streetAddress(),
            'city' => $fake->city(),
            'state' => $fake->state(),
        ];
    }
}
