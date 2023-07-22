<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->sentence(2);
        return [
            'name'=>$name,
            'slug'=>Str::slug($name),
            'price'=>$this->faker->numberBetween(100,150),
            'description'=>$this->faker->paragraph(),
        ];
    }
}
