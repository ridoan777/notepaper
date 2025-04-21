<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Faker\Factory as Faker;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create('en_US');  // Explicitly setting English locale
        User::factory(5)->create();
        // Note::factory()->count(2)->create();

        // User::factory(5)->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
