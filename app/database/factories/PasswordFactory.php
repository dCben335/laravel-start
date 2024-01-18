<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Password>
 */
class PasswordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();
    
        return [
            'site' => $this->faker->url,
            'login' => $this->faker->userName,
            'password' => $this->faker->password,
            'user_id' => $this->faker->randomElement($userIds),
        ];
               
    }
}
