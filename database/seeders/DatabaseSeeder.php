<?php

namespace Database\Seeders;

use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Post::factory(66)->create();

        // Post::factory()->create([
        //     'title' => 'Test User',
        //     'content' => 'test@example.com',
        // ]);
    }
}
