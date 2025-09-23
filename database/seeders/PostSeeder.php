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
        $post1 = Post::create([
            'title' => 'Post 1',
            'slug' => 'slug1-de-teste',
            'body' => 'Post 1 content',
            'cover' => 'https://picsum.photos/id/10/200/300',
            'status' => 'PUBLISHED',
            'authorId' => 1,
        ]);
        $post1->tags()->attach([1, 2]);

        $post2 = Post::create([
            'title' => 'Post 2',
            'slug' => 'slug2-de-teste',
            'body' => 'Post 2 content',
            'cover' => 'https://picsum.photos/id/10/200/300',
            'status' => 'PUBLISHED',
            'authorId' => 1,
        ]);
        $post2->tags()->attach([1, 3]);

        $post3 = Post::create([
            'title' => 'Post 3',
            'slug' => 'slug3-de-teste',
            'body' => 'Post 3 content',
            'cover' => 'https://picsum.photos/id/10/200/300',
            'status' => 'DRAFT',
            'authorId' => 1,
        ]);
        $post3->tags()->attach([3, 4]);

        $post4 = Post::create([
            'title' => 'Post 4',
            'slug' => 'slug4-de-teste',
            'body' => 'Post 4 content',
            'cover' => 'https://picsum.photos/id/10/200/300',
            'status' => 'PUBLISHED',
            'authorId' => 1,
        ]);
        $post4->tags()->attach([1, 2, 3, 4]);
    }
}
