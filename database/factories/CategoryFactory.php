<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->randomElements(['Cabelo', 'Barba', 'Facial', 'Hidratação', 'Pacote'])[0],
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            \App\Models\Service::factory(3)->create([
                'category_uuid' => $category->uuid,
                'client_uuid' => $category->client_uuid
            ]);
        });
    }
}
