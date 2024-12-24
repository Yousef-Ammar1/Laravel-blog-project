<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create()->each(function ($user) {
            Post::factory(5)->create([
                'user_id' => $user->id
            ])->each(function ($post) {
                Comment::factory(3)->create([
                    'post_id' => $post->id
                ]);
            });
        });


    }
}
