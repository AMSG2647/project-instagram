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

Use App\Image;

Route::get('/', function () {

    /*$images = Image::all(); // sacar todas las imagenes de la BD

    foreach($images as $image){
        echo $image->user->name.' '.$image->user->surname.'<br>';
        echo $image->image_path.'<br>';      
        echo $image->description.'<br>';

        foreach($image->comments as $comment){

            echo $comment->content.'<br>';
            echo $comment->created_at.'<br>';
        }
        echo "<hr>";
    }

    die();*/
    
    return view('welcome');
});

//GENERALES

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

//USUARIOS

Route::get('/configuracion', 'UserController@config')->name('config');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::post('/configuracion/update', 'UserController@update')->name('update');
Route::get('/profile/{id}', 'UserController@profile')->name('profile');
Route::get('/user/index/{search?}', 'UserController@index')->name('user.index');


//IMAGENES

Route::get('/subir-imagen', 'ImageController@create')->name('image.create');
Route::post('/image/save', 'ImageController@save')->name('image.save');
Route::get('/image/file{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/imagen/{id}', 'ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::get('/image/edit/{id}', 'ImageController@edit')->name('image.edit');
Route::post('/image/update', 'ImageController@update')->name('image.update');

//LIKES

Route::get('/like/{imagen_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{imagen_id}', 'LikeController@dislike')->name('like.delete');
Route::get('/likes', 'LikeController@index')->name('likes.index');

//COMENTARIOS

Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');
















