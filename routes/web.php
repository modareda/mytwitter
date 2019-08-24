<?php
use App\Events\WebsocketDemoEvent;

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

Route::get('/', function() {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => ['auth', 'web']],  function(){
    // Route::get('/home', function(){
    //     return view('home');
    // })->name('home');

    Route::get('/home', 'PostController@index')->name('home');
    Route::post('/home', 'PostController@store')->name('post.store');
    Route::delete('/home/{id}', 'PostController@delete')->name('post.delete');
    Route::post('/post/{post}', 'PostController@show');
    Route::get('/profile/{id}', 'ProfileController@index')->name('profile');
    Route::post('/follow/{id}', 'FollowController@follow')->name('user.follow');
    Route::post('/unfollow/{id}', 'FollowController@unfollow')->name('user.unfollow');
    Route::post('/post/{post}/like', 'LikeController@like');
    Route::post('/post/{post}/comment', 'CommentController@store');
    Route::get('/message', "MessageController@index")->name('messanger');
    Route::get('/message/{id}', "MessageController@show")->name('message');
    Route::post('/getMessage/{id}', "MessageController@get");
    Route::post('/message/{id}', "MessageController@store");
    Route::post('/tofollow', 'HomeController@index');
    
});
