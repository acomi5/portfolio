<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Post $post) {
        $like = new Like();
        $like->post_id = $post->id;
        $like->user_id = Auth::user()->id;
        $like->save();

        return back();
    }

    public function unlike(Post $post) {
        $user = Auth::user()->id;
        $like = Like::where('post_id', $post->id)->where('user_id', $user)->first();
        $like->delete();

        return back();
    }

    public function index(Post $post) {
        $posts = Post::all();
        $user = Auth::user();
        $like = Like::where('post_id', $post->id)->where('user_id', $user)->first();

        return view('post.show', compact('posts', 'like', 'user'));
    }
}
