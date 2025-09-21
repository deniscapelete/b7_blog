<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'Post 1',
            'slug' => 'slug-de-teste',
            'content' => 'Post 1 content',
            'cover' => 'https://picsum.photos/id/10/200/300',
            'status' => 'PUBLISHED',
            'authorId' => 1,
        ]);
    }
}
