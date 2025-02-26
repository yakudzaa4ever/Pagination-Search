<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        }
    
        $posts = $query->paginate(20);
    
        return response()->json([
            'status' => 200,
            'data' => $posts,
            'message' => 'Postlar muvaffaqiyatli olindi'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $post = Post::create($request->all());

        return response()->json([
            'status' => 201,
            'data' => $post,
            'message' => 'Post muvaffaqiyatli yaratildi'
        ], 201);
    }

    public function show($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'status' => 404,
                'message' => 'Post topilmadi'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $post,
            'message' => 'Post topildi'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'status' => 404,
                'message' => 'Post topilmadi'
            ], 404);
        }

        $post->update($request->all());

        return response()->json([
            'status' => 200,
            'data' => $post,
            'message' => 'Post muvaffaqiyatli yangilandi'
        ]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'status' => 404,
                'message' => 'Post topilmadi'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Post muvaffaqiyatli o‘chirildi'
        ]);
    }
}
