<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request, BlogPost $blogPost)
    {
        $user = Auth::user();

        if (!$user) {
            return back()->with('error', 'Необходимо войти в систему для того, чтобы поставить лайк.');
        }

        if ($existingLike = Like::where('user_id', $user->id)
            ->where('blog_post_id', $blogPost->id)
            ->first()) {
            return back()->with('error', 'Вы уже поставили лайк этому посту.');
        }

        $like = new Like([
            'user_id' => $user->id,
            'blog_post_id' => $blogPost->id,
        ]);
        $blogPost->likes()->save($like);

        return back()->with('success', 'Лайк поставлен!');
    }

    public function unlike(Request $request, BlogPost $blogPost){
        $user = Auth::user();

        if (!$user) {
            return back()->with('error', 'Необходимо войти в систему для того, чтобы убрать лайк.');
        }

        $like = Like::where('user_id', $user->id)
            ->where('blog_post_id', $blogPost->id)
            ->first();

        if ($like) {
            $like->delete();
            return back()->with('success', 'Лайк убран.');
        }

        return back()->with('error', 'Лайк не найден.'); // Если лайк не найден (возможно, пользователь не лайкал пост)
    }

}
