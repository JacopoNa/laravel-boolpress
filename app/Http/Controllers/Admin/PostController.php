<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $data = [
            'posts' => $posts
        ];
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $new_post = new Post();
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validation());
        $form_data = $request->all();
        $new_post = new Post();
        $new_post->fill($form_data);
        $new_post->slug = $this->getSlug($new_post->title);
        $new_post->save();
        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $data = [
            'post' => $post
        ];
        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $data = [
            'post' => $post 
        ];
        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate($this->validation());
        $form_data = $request->all();
        $post_to_update = Post::findOrFail($id);
        if ($post_to_update->title != $form_data['title']) {
            $form_data['slug'] = $this->getSlug($form_data['title']);
        } else {
            $form_data['slug'] = $post_to_update->slug;
        }

        $post_to_update->update($form_data);

        return redirect()->route('admin.posts.show', ['post' => $post_to_update->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function getSlug($title) {
        $potential_slug = Str::slug($title, '-'); 
        $existing_slug_post = Post::where('slug', '=', $potential_slug)->first();

        $slug_base = $potential_slug;
        $counter = 1; 
        while ($existing_slug_post) {
            $potential_slug = $slug_base . $counter;
            $existing_slug_post = Post::where('slug', '=', $potential_slug)->first();
            $counter++;
        }

        return $potential_slug;
    }

    public function validation() {
        return [
            'title' => 'bail|required|max:255',
            'content' => 'bail|required|max:60000',
        ];
    }
}
