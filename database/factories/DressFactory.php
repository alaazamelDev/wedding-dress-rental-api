<?php

namespace Database\Factories;

use App\Infrastructure\Models\Dress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dress>
 */
class DressFactory extends Factory
{
    protected $model = Dress::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'image_url' => fake()->imageUrl(),
            'rental_price' => fake()->numberBetween(100, 6548),
            'description' => fake()->text(),
            'size' => fake()->numberBetween(30, 45),
        ];
    }
}
