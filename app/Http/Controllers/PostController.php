<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public  function index()
    {
        return view('posts.index', [
            'posts'=>  Post::latest()->filter(
                request(['search','category','author']))
                ->paginate(4)->withQueryString(),
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show',[
            'post' => $post,
            'user' => User::where('id',$post->user_id)->get()->first(),
        ]);
    }

}
