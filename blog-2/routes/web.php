<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\NewsletterController;
use App\Http\Middleware\MustBeAdministrator;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Validation\ValidationException;
use App\Jobs\SendWelcomeEmail;
use App\Jobs\ProcessPayment;
use App\Jobs\PullRepo;
use App\Jobs\RunTests;
use App\Jobs\Deploy;


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
Route::get('/', function(){
        $batch=[
            new \App\Jobs\PullRepo('laracasts/project1'),
            new \App\Jobs\RunTests('laracasts/project2'),
            new \App\Jobs\Deploy('laracasts/project3'),
        ];

        \Illuminate\Support\Facades\Bus::batch($batch)->dispatch();

    return ('home');
});
Route::post('newsletter', NewsletterController::class);
//Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');
Route::get('admin/posts/create', [PostController::class, 'create']);
Route::get('admin/posts', [PostController::class, 'store']);


Route::get('authors/{author:username}', function(User $author){

    
    return view('posts.index', [
        
        'posts' => $author->posts,
        

     ]);
    });
