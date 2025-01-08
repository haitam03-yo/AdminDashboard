<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductFactory extends Factory // Class name matches file name
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(), // Generate a UUID for the 'id' field
            'categorie' => $this->faker->word, // Random word for category
            'marque' => $this->faker->company, // Random company name for brand
            'prix_unitaire' => $this->faker->randomFloat(2, 10, 1000), // Random price between 10 and 1000
            'promotion' => $this->faker->boolean, // Random boolean for promotion
            'stock_disponible' => $this->faker->numberBetween(0, 100), // Random stock between 0 and 100
        ];
    }
}