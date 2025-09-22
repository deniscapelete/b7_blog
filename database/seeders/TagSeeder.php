<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tag1 = Tag::create(['name' => 'PHP tag1']);
        $tag2 = Tag::create(['name' => 'Laravel tag2']);
        $tag3 = Tag::create(['name' => 'JavaScript tag3']);
        $tag4 = Tag::create(['name' => 'Next.js tag4']);
    }
}
