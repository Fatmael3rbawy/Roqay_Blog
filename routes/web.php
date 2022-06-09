<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\FatorahController;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Post;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $posts = Post::orderby('id','desc')->paginate(9);
    return view('dashboard',compact('posts'));
})->name('dashboard');

//Facebook Login
Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);
 
//Github Login
Route::get('auth/github', [GitHubController::class, 'redirectToGithub']);
Route::get('auth/github/callback', [GitHubController::class, 'handleGithubCallback']);


Route::middleware('auth')->group(function () {
    // Route::resources([
    //     //Post CRUD Routes
    //     'photos' => PhotoController::class,
    //     'posts' => PostController::class,
    // ]);
//Post CRUD Routes
Route::get('/posts' , [PostController::class ,'index'])->name('posts.index');
Route::get('/post/create' , [PostController::class ,'create'])->name('posts.create');
Route::post('/post/store' , [PostController::class ,'store'])->name('posts.store');
Route::get('/post/show/{id}' , [PostController::class ,'show'])->name('posts.show');
Route::get('/post/edit/{id}' , [PostController::class ,'edit'])->name('posts.edit');
Route::post('/post/update/{id}' , [PostController::class ,'update'])->name('posts.update');
Route::post('/post/destroy' , [PostController::class ,'destroy'])->name('posts.destroy');

// User CRUD Routes
Route::get('/myProfile' , [UserController::class ,'index'])->name('user.profile');
Route::get('/user/edit' , [UserController::class ,'edit'])->name('user.edit');
Route::post('/user/update' , [UserController::class ,'update'])->name('user.update');
Route::delete('/user/destroy' , [UserController::class ,'destroy'])->name('user.destroy');

//Transaction routes
Route::get('/myPayments' , [TransactionController::class ,'payments'])->name('user.payments');
Route::delete('/transaction/destroy/{id}' , [TransactionController::class ,'destroy'])->name('transaction.destroy');


//Tag CRUD Routes
Route::get('/tags' , [TagController::class ,'index'])->name('tag.index');
Route::get('/tag/create' , [TagController::class ,'create'])->name('tag.create');
Route::post('/tag/store' , [TagController::class ,'store'])->name('tag.store');
Route::get('/tag/edit/{id}' , [TagController::class ,'edit'])->name('tag.edit');
Route::post('/tag/update/{id}' , [TagController::class ,'update'])->name('tag.update');
Route::post('/tag/destroy/{id}' , [TagController::class ,'destroy'])->name('tag.destroy');


//Category CRUD Routes
Route::get('/categories' , [CategoryController::class ,'index'])->name('category.index');
Route::get('/category/create' , [CategoryController::class ,'create'])->name('category.create');
Route::post('/category/store' , [CategoryController::class ,'store'])->name('category.store');
Route::get('/category/edit/{id}' , [CategoryController::class ,'edit'])->name('category.edit');
Route::post('/category/update/{id}' , [CategoryController::class ,'update'])->name('category.update');
Route::delete('/category/destroy/{id}' , [CategoryController::class ,'destroy'])->name('category.destroy');


//Fatorah Routes


Route::get('/pay',[FatorahController::class,'pay'])->name('mailActivation');
Route::get('/paymentResponse/{id}',[FatorahController::class,'payment_response']);

Route::get('/callback',[FatorahController::class,'callback']);
Route::get('/error',[FatorahController::class,'error']);

});

//chat routes
Route::get('/chats', [ChatsController::class,'index'])->name('users.chat');
Route::get('messages', [ChatsController::class,'fetchMessages']);
Route::post('/messages', [ChatsController::class,'sendMessage']);


require __DIR__.'/auth.php';
