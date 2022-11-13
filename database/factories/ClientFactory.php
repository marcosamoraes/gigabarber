<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'company_name' => fake()->company(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'logo' => fake()->imageUrl(100, 100, 'Logo'),
            'whatsapp' => fake()->cellphoneNumber(),
            'cnpj' => fake()->unique()->cnpj()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function configure()
    {
        return $this->afterCreating(function (Client $client) {
            $config = ['client_uuid' => $client->uuid];
            \App\Models\ClientAttribute::factory(1)->create($config);
            \App\Models\ClientAddress::factory(1)->create($config);
            \App\Models\Category::factory(3)->create($config);
        });
    }
}
