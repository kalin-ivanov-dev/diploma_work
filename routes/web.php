<?php


use App\Http\Controllers\Admin\AdminCommentsController;
use App\Http\Controllers\Admin\Post\AdminPostController;
use App\Http\Controllers\Admin\AdminUserCommentsController;
use App\Http\Controllers\Admin\AdminUserPostsController;
use App\Http\Controllers\ChangeUsrPassword;
use App\Http\Controllers\UserController;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserPostController;
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

Route::get('/posts', [PostController::class,'index'])->name('posts');
Route::get('/',function (){
    return view('layouts.landing');
})->name('home');

Route::get('posts/{post:slug}', [PostController::class,'show']);
//Route::get('register', [RegisterController::class,'create'])->middleware('guest');
//Route::post('register', [RegisterController::class,'store'])->middleware('guest');

Route::post('posts/{post:slug}/comments',[PostCommentsController::class,'store']);

//MAILCHIMP ROUTE
Route::post('newsletter',NewsletterController::class);

//Admin Post Routes
Route::get('user/posts/create',[UserPostController::class,'create'])->middleware('auth'); //Get create page for posts
Route::post('user/posts',[UserPostController::class,'store'])->middleware('auth'); // Create  a post
Route::get('user/posts/',[UserPostController::class,'index'])->middleware('auth'); // Show all posts
Route::get('user/comments/',[UserPostController::class,'comments'])->middleware('auth'); // Show all posts
Route::get('user/posts/{post}/edit',[UserPostController::class,'edit'])->middleware('auth'); // Edit a post
Route::patch('user/posts/{post}',[UserPostController::class,'update'])->middleware('auth'); // Edit a post
Route::delete('user/posts/{post}',[UserPostController::class,'destroy'])->middleware('auth'); // Edit a post

Route::get('user/profile/',[UserController::class,'index'])->middleware('auth'); // Show all posts
Route::get('user/profile/{user}/edit',[UserController::class,'edit'])->middleware('auth');
Route::get('user/{user}/change-password', [ChangeUsrPassword::class,'index'])->middleware('auth');
Route::post('user/{user}/change-password', [ChangeUsrPassword::class,'store'])->name('change.password')->middleware('auth');




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

Route::post('admin/dashboard', function () {

    if(request()->has('id_comment') && request()->has('is_approved'))
    {
        $comment = Comment::where('id',request()->all()['id_comment'])->first();
        if(!is_null($comment))
        {
            $comment->is_active = request()->all()['is_approved'];
            $comment->update();
            return response()->json(['status' => $comment->is_active]);
            dump($comment);
        }

    }
    dump(request()->has('id_comment'));
    dd(request()->all());
})->middleware(['admin'])->name('dashboard');


//User posts
Route::get('admin/user/{user}/posts',[AdminUserPostsController::class,'index'])->middleware(['admin']);

// User comments
Route::get('admin/user/{user}/comments',[AdminUserCommentsController::class,'index'])->middleware(['admin']);
Route::delete('admin/user/{user}/comments/{comment}',[AdminUserCommentsController::class,'destroy'])->middleware(['admin']);

// Admin Users
Route::get('admin/user/{user}/edit',[AdminUserPostsController::class,'edit'])->middleware(['admin']);
Route::patch('admin/user/{user}',[AdminUserPostsController::class,'update'])->middleware('auth');
Route::delete('admin/user/{user}',[AdminUserPostsController::class,'destroy'])->middleware('auth');

// Admin Posts
Route::get('admin/posts',[AdminPostController::class,'index'])->middleware(['admin'])->name('admin_posts');
Route::get('admin/posts/{post}/edit',[AdminPostController::class,'edit'])->middleware(['admin']);
Route::patch('admin/posts/{post}',[AdminPostController::class,'update'])->middleware('auth');
Route::delete('admin/posts/{post}',[AdminPostController::class,'destroy'])->middleware('auth');

// Admin post comments
Route::get('admin/posts/{post}/comments',[AdminPostController::class,'comments'])->middleware(['admin']);

// Admin comments
Route::get('admin/comments/',[AdminCommentsController::class,'index'])->middleware('auth');
Route::get('admin/comments/{comment}/edit',[AdminCommentsController::class,'edit'])->middleware('auth');
Route::patch('admin/comments/{comment}',[AdminCommentsController::class,'update'])->middleware('auth');

require __DIR__.'/auth.php';
