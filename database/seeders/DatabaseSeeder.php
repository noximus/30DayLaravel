<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create(['first_name' => 'Henry',
            'last_name' => 'Richardson',
            'email' => 'test@example.com',
        ]);

        User::factory(10)->create();

        $this->call(JobSeeder::class);
    }
}
