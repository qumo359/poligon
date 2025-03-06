<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function show(BlogCategory $category) // Используем Route Model Binding для получения категории по slug или id
    {
        // Загружаем посты, принадлежащие данной категории, с жадной загрузкой категории
        $posts = $category->posts()->withCount('category')->latest()->paginate(9); // Например, 9 постов на страницу, отсортированные по дате создания
        $categories = (new \App\Models\BlogCategory)->withCount('posts')->get();
        $latestPosts = BlogPost::latest('created_at')->take(5)->get();

        return view('blog.categories.show', compact('category', 'posts', 'categories','latestPosts')); // Передаем категорию и посты в шаблон
    }
}
