<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $query = Post::query();
        if (!empty($keyword)) {
            $query->where('user_id', 'like', "%{$keyword}%")
                ->orWhere('comment', 'like', "%{$keyword}%");
        }
        $posts = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('home', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'max:150',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $post = new Post();

        $file = $request->file('image');
        $path = Storage::disk('s3')->putFile('/', $file, 'public');
        $post->image = Storage::disk('s3')->url($path);
        // $name = $file->hashName();
        // $file->move('storage/images', $name);
        $post->image = $path;

        $post->comment = $request->input('comment');
        $post->user_id = Auth::id();
        $post->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // $post = Post::find($id);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'max:150',
            'image' => 'file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($file = $request->image) {
            $path = Storage::disk('s3')->putFile('/', $file, 'public');
            $post->image = Storage::disk('s3')->url($path);
            // $name = $file->hashName();
            // $file->move('storage/images', $name);
            $post->image = $path;
        }
        $post->comment = $request->input('comment');
        $post->user_id = Auth::id();
        $post->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return back();
    }
}
