<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Получаем все посты и жадно загружаем связь 'category'
        // $items = BlogPost::with('category')->get();
        $latestPosts = BlogPost::latest('created_at')->take(5)->get();
        $categories = BlogCategory::withCount('posts')->get();
        $items = BlogPost::paginate(10);

        return view('blog.posts.index', compact('categories', 'items', 'latestPosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function search(Request $request)
    {
        $posts = BlogPost::where('title', 'like', "%$request->title%")->orWhere('content_raw', 'like', "%$request->title%")->get();
dd($posts);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = BlogPost::find($id);
        $categories = BlogCategory::withCount('posts')->get();
        $latestPosts = BlogPost::latest('created_at')->take(5)->get();
        if(empty($item)) return abort(404);

        $comments = $item->comments()->with('user')->latest()->get();

        $prev = BlogPost::where('category_id', $item->category_id)->where('id', '<', $item->id)->first();
        $next = BlogPost::where('category_id', $item->category_id)->where('id', '>', $item->id)->first();

        return view('blog.posts.show', compact('item', 'comments', 'categories', 'latestPosts', 'prev', 'next'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->ip();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
