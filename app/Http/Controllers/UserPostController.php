<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserPostController extends Controller
{
    public  function index()
    {
        return view('user.posts.index',[
            'posts' => Post::where('user_id',auth()->id())->paginate(10),
            'user' => User::where('id',auth()->id())->get()->first(),
        ]);
    }

    public  function comments()
    {
        return view('user.posts.comments',[
            'comments' => Comment::where('user_id',auth()->id())->paginate(10),
            'user' => User::where('id',auth()->id())->get()->first(),
        ]);
    }

    public function create()
    {
        return view('user.posts.create');
    }

    public function store()
    {

        $attributes = $this->validatePost(new Post);
        $attributes['user_id'] = auth()->id();

        if(!request()->hasFile('post_images'))
            return back()->with('error',['files' => 'Please upload at least one file for the signal']);
        else
        {
            $image_ids = $this->uploadFiles(\request());
        }

//        if(request('longitude') === null || request('latitude') === null)
//        {
//            return back()->with('error',['gmap' => 'Please choose a location of the signal']);
//        }
        $attributes['longitude'] = \request('longitude');
        $attributes['latitude'] = \request('latitude');

        $attributes['slug'] = $this->generateSlug(\request()->title);

        $post = Post::create($attributes);


        if (isset($image_ids) && !empty($image_ids))
        {
           foreach ($image_ids as $image_id)
           {
               $postImage = new PostImage();
               $postImage->post_id = $post->id;
               $postImage->image_id = $image_id;
               $postImage->save();
           }
        }

        return redirect('/user/posts')->with('success','Signal Successfully Created');
    }


    private function uploadFiles(Request $request)
    {
        $image_ids = [];

        if($request->hasFile('post_images'))
        {
            foreach ($request->file('post_images') as $file) {

                $img_path = $file->store('uploads');
                $image = new Image();
                $image->path = $img_path;
                $image->save();

                $image_ids[] = $image->id;
            }

            return $image_ids;
        }
    }


    public function edit(Post $post)
    {
        if($post->user_id != auth()->id())
        {
            return redirect('/user/posts')->with('error','This post is not associated to your profile');
        }
        return view('user.posts.edit',['post'=> $post]);
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

        return redirect('/user/posts')->with('success','Signal Updated Successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success','Signal Deleted');
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

    private function generateSlug($name)
    {
        $random_string =  Str::limit(md5(Str::random(10)).Str::random(30),15,'');
        $slug = Str::slug($name,'_')."_{$random_string}";
//        $test = 'repellendus-veniam-porro-fugiat-et';
        $check_signal_slug = Post::where('slug','like','%' . $slug.'%')->get()->first();

        if($check_signal_slug === null)
           return  $slug;
        else
        {
          return $this->generateSlug($name);
        }

    }


}
