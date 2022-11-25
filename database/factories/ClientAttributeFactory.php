<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClientAttribute>
 */
class ClientAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'public_email' => fake()->unique()->safeEmail(),
            'image' => fake()->imageUrl(500, 700, 'Imagem de Fundo'),
            'description_footer' => fake()->paragraph(),
            'primary_color' => fake()->hexColor(),
            'text_color' => fake()->hexColor(),
            'link_facebook' => 'https://facebook.com',
            'link_instagram' => 'https://instagram.com',
        ];
    }
}
