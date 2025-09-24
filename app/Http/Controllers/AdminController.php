<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function CreatePost(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'status' => 'in:DRAFT,PUBLISHED',
            'tags' => 'string|max:255',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->authorId = $user->id;

        if (!$request->has('status')) {
            $post->status = 'DRAFT';
        };

        // Gerar slug com base no título do post
        $post->slug = Str::slug($post->title) . '-' . time();

        // Upload de Imagem (Cover)

        // Subir a imagem para o servidor
        // Garantir que a extensão seja jpg, png ou gif
        // Garantir que o nome do arquivo seja único
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            if (!$file->isValid()) {
            }

            if (!in_array($file->getClientOriginalExtension(), ['png', 'jpg', 'gif'])) {
                return response()->json(['error' => 'Invalid file type'], 422);
            }

            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);

            $post->cover = env('APP_URL') . '/uploads/' . $filename;
        }

        $post->save();

        if ($request->has('tags')) {
            $tags = explode(',', $request->input('tags'));
            foreach ($tags as $tag) {
                $tag = trim($tag);
                $tagModel = Tag::firstOrCreate(['name' => $tag]);
                $post->tags()->attach($tagModel->id);
            };
        }

        return response()->json([
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
        ], 201);
    }
}
