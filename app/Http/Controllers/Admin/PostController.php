<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderByDesc('id')->get();
        //dd($posts);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //dd($request->all());

        //validate data
        $val_data = $request->validated();
        //generate the slug
        $slug = Str::slug($request->title, '-');
        //dd($slug);
        $val_data['slug'] = $slug;
        //create the resource
        Post::create($val_data);
        //redirect to a get route
        return redirect()->route('admin.posts.index')->with('message', 'Post Created gj!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest;  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //dd($request->all());
        /*validate data con PostRequest*/
        //$val_data = $request->validated();
        /*validate data unique*/
        $val_data = $request->validate([
            'title' => ['required', Rule::unique('posts')->ignore($post)],
            'cover_image' => 'nullable',
            'content' => 'nullable'
        ]);

        //dd($val_data);
        //generate slug
        $slug = Str::slug($request->title, '-');
        $val_data['slug'] = $slug;
        //update data
        $post->update($val_data);

        //redirect to get route
        return redirect()->route('admin.posts.index')->with('message', "$post->title Your post is now updated!");

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
        return redirect()->route('admin.posts.index')->with('message', "$post->title GG" );
    }
}
