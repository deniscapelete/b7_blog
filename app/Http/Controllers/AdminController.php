<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getPosts(Request $request)
    {
        $user = $request->user();

        $posts_per_page = 10;

        $posts = Post::where('authorId', $user->id)->paginate($posts_per_page);
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
                'status' => $post->status,
            ];
        }

        return [
            'posts' => $pagesPosts,
            'page' => $posts->currentPage(),
        ];
    }

    public function getPost(string $slug, Request $request)
    {
        $user = $request->user();

        $post = Post::where(['slug' => $slug, 'authorId' => $user->id])->first();

        if (!$post) {
            return response()->json(['error' => '404 Not found'], 404);
        }

        return [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'createdAt' => $post->createdAt,
                'cover' => $post->cover,
                'authorName' => $post->author->name,
                'tags' => $post->tags->implode('name', ', '),
                'body' => $post->body,
                'slug' => $post->slug,
                'status' => $post->status,
            ]
        ];
    }

    public function deletePost(string $slug, Request $request)
    {
        $user = $request->user();

        $post = Post::where(['slug' => $slug, 'authorId' => $user->id])->first();
        if (!$post) {
            return response()->json(['error' => '404 Not found'], 404);
        }
        $post->delete();
        return  response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
