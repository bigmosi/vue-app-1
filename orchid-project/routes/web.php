<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
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

Route::get('/', function () {

    $files = File::files(resource_path("posts/"));
   
    $documents = [];

    foreach($files as $file) {

        $documents[] = YamlFrontMatter::parseFile($file);
    }
    

    ddd($documents);

//    $posts = Post::all();

//    return view('posts', [
//        'posts' => Post::all()
//    ]);
});

Route::get('posts/{post}', function($slug){

    $post = Post::find($slug);

    return view('post', [

        'post' => $post
    ]);

})->where('post', '[A-z_\-]+');
