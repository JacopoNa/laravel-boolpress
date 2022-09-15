<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;

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
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'categories' => $categories,
            'tags' => $tags
        ];
        return view('admin.posts.create', $data);
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

        if (isset($form_data['image'])) {
            $img_path = Storage::put('post_covers', $form_data['image']);
            $form_data['cover'] = $img_path;
        }

        $new_post->fill($form_data);
        $new_post->slug = $this->getSlug($new_post->title);
        $new_post->save();

        if (isset($form_data['tags'])) {
            $new_post->tags()->sync($form_data['tags']);
        }
        
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
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
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
        
        if (isset($form_data['tags'])) {
            $post_to_update->tags()->sync($form_data['tags']);
        } else {
            $post_to_update->tags()->sync([]);
        }

        if (isset($form_data['image'])) {
            if ($post_to_update->cover) {
                Storage::delete($post_to_update->cover);
            }

            $img_path = Storage::put('post_covers', $form_data['image']);
            $form_data['cover'] = $img_path;
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
        $post_to_delete = Post::findOrFail($id);
        $post_to_delete->tags()->sync([]);
        $post_to_delete->delete();

        return redirect()->route('admin.posts.index');
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
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            'cover' => 'nullable|max:2048'
        ];
    }
}
