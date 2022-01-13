<?php

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
Route::get('register', [RegisterController::class,'create'])->middleware('guest');
Route::post('register', [RegisterController::class,'store'])->middleware('guest');

Route::post('posts/{post:slug}/comments',[PostCommentsController::class,'store']);

//MAILCHIMP ROUTE
Route::post('newsletter',NewsletterController::class);

//Admin Post Routes
Route::get('admin/posts/create',[AdminPostController::class,'create'])->middleware('admin'); //Get create page for posts
Route::post('admin/posts',[AdminPostController::class,'store'])->middleware('admin'); // Create  a post
Route::get('admin/posts/',[AdminPostController::class,'index'])->middleware('admin'); // Show all posts
Route::get('admin/posts/{post}/edit',[AdminPostController::class,'edit'])->middleware('admin'); // Edit a post
Route::patch('admin/posts/{post}',[AdminPostController::class,'update'])->middleware('admin'); // Edit a post
Route::delete('admin/posts/{post}',[AdminPostController::class,'destroy'])->middleware('admin'); // Edit a post






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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
