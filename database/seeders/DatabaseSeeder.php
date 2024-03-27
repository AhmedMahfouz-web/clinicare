<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Price;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Admin::factory(1)->create();
        \App\Models\Profession::factory(10)->create();
        \App\Models\Expiry::factory(1)->create();
        $models = array(
            'report',
            'meeting',
            'reservation'
        );

        foreach ($models as $model) {
            Price::create([
                'model' => $model
            ]);
        }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
