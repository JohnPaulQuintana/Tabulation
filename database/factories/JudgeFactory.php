<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Judge>
 */
class JudgeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => false,
            'user_id' => true,
            'name' => 'administrator',
            'address' => 'administrator',
            'position' => 'administrator',
            'code' => 'AD2024MNZQ',
        ];
    }
}
