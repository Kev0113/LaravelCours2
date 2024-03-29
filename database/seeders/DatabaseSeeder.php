<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Event;
use App\Models\EventToUser;
use App\Models\Opinion;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        User::factory(10)->create();
        Category::factory(50)->create();
        Event::factory(100)->create();
        Comment::factory(200)->create();
        Opinion::factory(450)->create();
    }
}
