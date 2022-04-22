<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::group(['middleware' => 'guest'], function(){

Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');


Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
});

//ログイン中のページ
Route::group(['middleware' => ['auth']], function(){

Route::get('/top','PostsController@index');


Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    // ツイート関連
// Route::resource('posts', 'PostsController', ['only' => ['index','store','destroy']]);
Route::resource('posts', 'PostsController', ['only' => ['index','store','edit','destroy']]);
// Route::get('posts/edit', 'PostsController@edit')->name('edit');

Route::get('/profile','UsersController@profile');

Route::get('users/{id}/yourprofile','UsersController@show')->name('yourprofile');

Route::get('/search','UsersController@index');


Route::get('/follow-list','PostsController@index')->name('follow-list');
Route::get('/follower-list','PostsController@index')->name('follower-list');

//Route::get('/follow-list','FollowsController@index');
//Route::get('/follower-list','FollowsController@index');

// ユーザ関連
Route::resource('users', 'UsersController', ['only' => ['edit','update']]);

// フォロー/フォロー解除を追加->name()名前を付ける：ビュー側で書きやすい
Route::post('users/{id}/follow', 'UsersController@follow')->name('follow');
Route::delete('users/{id}/unfollow', 'UsersController@unfollow')->name('unfollow');


});
