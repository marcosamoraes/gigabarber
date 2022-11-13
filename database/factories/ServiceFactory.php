<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->randomElements(['Cabelo Longo', 'Pézinho', 'Cabelo Curto', 'Cabelo e Barba'])[0],
            'description' => fake()->sentence(5),
            'value' => fake()->randomFloat(2, 10, 100),
        ];
    }
}
