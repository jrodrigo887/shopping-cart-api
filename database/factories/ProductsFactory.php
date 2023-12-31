<?php

namespace Database\Factories;

use App\Models\Checkout;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'name' => $this->faker->words(2, true),
           'description' => $this->faker->sentence,
           'price' => $this->faker->randomFloat(2, 10, 300),
           'checkout_id' => Checkout::factory()->create(),
        ];
    }
}
