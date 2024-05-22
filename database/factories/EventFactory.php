<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>'Welcome to Tabulation',
            'details'=>"Our app is designed to streamline your tabulation process, offering you accurate and efficient results. Whether you're managing data, calculating scores, or organizing information, we've got you covered.",
            'type'=>'System Message',
            'image'=>"public/images/welcome.png",
            'status'=>false
        ];
    }
}
