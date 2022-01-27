<?php

use App\Http\Controllers\Admin\AdminUserCommentsController;
use App\Http\Controllers\Admin\AdminUserPostsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/















use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/welcome',function (){
    return view('welcome') ;
});

Route::get('/', [PostController::class,'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class,'show']);
//Route::get('register', [RegisterController::class,'create'])->middleware('guest');
//Route::post('register', [RegisterController::class,'store'])->middleware('guest');

Route::post('posts/{post:slug}/comments',[PostCommentsController::class,'store']);

//MAILCHIMP ROUTE
Route::post('newsletter',NewsletterController::class);

//Admin Post Routes
Route::get('user/posts/create',[AdminPostController::class,'create'])->middleware('auth'); //Get create page for posts
Route::post('user/posts',[AdminPostController::class,'store'])->middleware('auth'); // Create  a post
Route::get('user/posts/',[AdminPostController::class,'index'])->middleware('auth'); // Show all posts
Route::get('user/comments/',[AdminPostController::class,'comments'])->middleware('auth'); // Show all posts
Route::get('user/posts/{post}/edit',[AdminPostController::class,'edit'])->middleware('auth'); // Edit a post
Route::patch('user/posts/{post}',[AdminPostController::class,'update'])->middleware('auth'); // Edit a post
Route::delete('user/posts/{post}',[AdminPostController::class,'destroy'])->middleware('auth'); // Edit a post

Route::get('user/profile/',[UserController::class,'index'])->middleware('auth'); // Show all posts





//Route::get('categories/{category:slug}', function (Category $category) {
//    return view('posts',[
//        'posts' => $category->posts,
//        'currentCategory' => $category,
//        'categories' => Category::all(),
//    ]);
//
//})->name('category');

//Route::get('authors/{author:username}', function (User $author) {
//    return view('posts.index',[
//        'posts' => $author->posts,
//    ]);
//
//});


Auth::routes();
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');



//Route::get('/', [RegisteredUserController::class, 'create']);

Route::get('admin/dashboard', function () {

    if(request()->has('query'))
    {
        $query = request()->all()['query'];
        $filterResult = User::where('username', 'LIKE', '%'. $query. '%')->get('username');

        return response()->json($filterResult);
    }

    $users = User::all();

    return view('dashboard',[
        'users' => $users,
    ]);
})->middleware(['admin'])->name('dashboard');

Route::get('admin/user/{user}/posts',[AdminUserPostsController::class,'index'])->middleware(['admin']);

Route::get('admin/user/{user}/comments',[AdminUserCommentsController::class,'index'])->middleware(['admin']);
Route::delete('admin/user/{user}/comments/{comment}',[AdminUserCommentsController::class,'destroy'])->middleware(['admin']);

Route::get('admin/user/{user}/edit',[AdminUserPostsController::class,'edit'])->middleware(['admin']);
Route::patch('admin/user/{user}',[AdminUserPostsController::class,'update'])->middleware('auth');
Route::delete('admin/user/{user}',[AdminUserPostsController::class,'destroy'])->middleware('auth');
require __DIR__.'/auth.php';
