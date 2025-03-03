<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, BlogPost $post)
    {
        $request->validate([
            'body' => 'required|string|max:500',
        ]);

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->user_id = auth()->id();
        $comment->body = strip_tags($request->body, '<p><a><ul><ol><li><b><strong><i><em><br><span><div>');
        $comment->save();

        if (Auth::check()) { // Если пользователь авторизован, связываем комментарий с пользователем
            $comment->user_id = Auth::id();
        }

        $post->comments()->save($comment); // Связываем комментарий с постом и сохраняем

        return back()->with('success', 'Комментарий успешно добавлен!'); // Возвращаемся назад на страницу поста
    }
}
