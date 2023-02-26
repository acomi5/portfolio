<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class UserController extends Controller
{
    public function profile()
    {
        $posts = Post::where('user_id', Auth::id())->latest()->get();
        $user = Auth::user();

        return view('user.profile', compact('posts', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = $request->user();
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255',
            'avatar' => 'file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($file = $request->avatar) {
            $name = $file->hashName();
            $file->move('storage/profiles', $name);
            $user->avatar = $name;
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user = Auth::user();
        $user->save();

        return to_route('profile');
    }
}
