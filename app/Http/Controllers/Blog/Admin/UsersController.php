<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends BaseController
{
    public function index()
    {
        $users = \App\Models\User::all();
        return view('blog.admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('blog.admin.users.edit',compact('user'));
    }

    public function update(Request $request, $user)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user,
        ]);

        $user = User::find($user);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect('/admin/blog/users')->with('success', 'Данные пользователя успешно обновлены.');
    }

    public function destroy(User $user)
    {
//        if (auth()->user()->id == $user->id) { // Защита от удаления самого себя
//            return redirect()->route('admin.users.index')->with('error', 'Вы не можете удалить самого себя.');
//        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно удален.');
    }
}
