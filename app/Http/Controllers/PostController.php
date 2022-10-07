<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = PostModel::latest()->paginate(5);

        return view('posts.index')->with('posts', $posts)
        ->with('i', (request()->input('page', 1) -1) *5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required'
        ]);

        PostModel::create($request->all());

        return redirect()->route('posts.index')
            ->with('success', "Post created sucessfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostModel  $post
     * @return \Illuminate\Http\Response
     */
    public function show(PostModel $post)
    {
        return view('posts.show')
            ->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostModel  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(PostModel $post)
    {
        return view('posts.edit')
            ->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostModel  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostModel $post)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required'
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')
            ->with('success', "Post: $post->name, updated sucessfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostModel  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        $post = PostModel::find($post)->first();

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', "Post deleted successfully.");
    }
}
