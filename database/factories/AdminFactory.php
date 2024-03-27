<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Uuid::generate(),
            'name' => 'Admin',
            'email' => 'admin@cliniccare.com',
            'password' => static::$password ??= Hash::make('password'),
            'role' => 'صاحب منشأة',
            'active' => 1
        ];
    }
}
