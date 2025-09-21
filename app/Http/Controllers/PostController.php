<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getPosts(Request $request)
    {
        $posts_per_page = 2;


        $posts = Post::paginate($posts_per_page);
        $pagesPosts = [];
        foreach ($posts as $post) {
            $pagesPosts[] = [
                'id' => $post->id,
                'title' => $post->title,
                'createdAt' => $post->createdAt,
                'cover' => $post->cover,
                'authorName' => $post->author->name,
                'tags' => $post->tags->implode('name', ', '),
                'body' => $post->body,
                'slug' => $post->slug,
            ];
        }


        return [
            'posts' => $pagesPosts,
            'page' => $posts->currentPage(),
        ];
    }
}
