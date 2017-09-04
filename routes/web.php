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
Route::get('/', 'GuestsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'member', 'middleware'=>['auth','role:member']], function(){
    Route::resource('images','ImagesController');
    Route::resource('comments','CommentsController');

    Route::post('images/store', array(
        'as' => 'img-store', 'uses' => 'ImagesController@store'));
    Route::get('album/{id}/show', array(
        'as' => 'album.user', 'uses' => 'GuestsController@show'));
});

Route::group(['prefix'=>'admin', 'middleware'=>['auth','role:admin']], function(){
    Route::resource('users', 'UsersController');
    Route::get('user', array(
        'as' => 'admin-user', 'uses' => 'UsersController@index'));
    
});
//routing ajax untuk menu admin : author
