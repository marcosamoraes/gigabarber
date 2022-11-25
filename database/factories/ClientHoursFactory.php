<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClientHours>
 */
class ClientHoursFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $days = [
            'segunda',
            'terça',
            'quarta',
            'quinta',
            'sexta',
            'sábado',
            'domingo',
        ];
        return [
            'day' => fake()->randomElements($days)[0],
            'open_time' => '08:00',
            'close_time' => '18:00',
        ];
    }
}
