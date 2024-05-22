<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Event::factory()->create([
            'name'=>'Welcome to AMA Tabulation System',
            'details'=>"Our app is designed to streamline your tabulation process, offering you accurate and efficient results. Whether you're managing data, calculating scores, or organizing information, we've got you covered.",
            'type'=>'System Message',
            'image'=>"public/images/welcome.png",
            'status'=>false
        ]);
        \App\Models\User::factory()->create([
            'name' => "Administrator",
            'code' => 'AD2024MNZQ',
            'email' => "admin@example.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'isAdmin' => true,
            'remember_token' => Str::random(10),
        ]);
        \App\Models\Judge::factory()->create([
            'event_id' => 1,
            'user_id' => 1,
            'name' => 'administrator',
            'address' => 'administrator',
            'position' => 'administrator',
            'code' => 'AD2024MNZQ',
        ]);

        

        
    }
}
