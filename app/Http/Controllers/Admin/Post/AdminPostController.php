<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public  function index()
    {
        return view('admin.posts.index',[
            'posts' => Post::all(),
        ]);
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit',['post'=> $post]);
    }

    public function update(Post $post)
    {
        $attributes  = $this->validatePost($post);

        if(isset($attributes['thumbnail']))
        {
            $attributes['thumbnail'] = \request()->file('thumbnail')->store('thumbnails');
        }

//        if(request('longitude') === null || request('latitude') === null)
//        {
//            return back()->with('error',['gmap' => 'Please choose a location of the signal']);
//        }

        $attributes['longitude'] = \request('longitude');
        $attributes['latitude']  = \request('latitude');

        $post->update($attributes);

        return redirect('/admin/posts')->with('success','Signal Updated Successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success','Post Deleted Successfully');
    }

    public  function  comments(Post $post)
    {
        return view('admin.posts.comments.index',[
            'comments' => $post->comments()->get(),
        ]);
    }

    protected  function validatePost(?Post $post = null) : array
    {
        $post  = $post ?? null;
//        Str::slug(\request('title')
        ;
        return request()->validate([
            'title' => 'required',
            'excerpt'  => 'required|max:255',
            'body'  => 'required',
            'category_id' => ['required',Rule::exists('categories','id')]
        ]);
    }
}
