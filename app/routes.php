<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*--------------------------------------------------------------------------------------------------------------------*/
// Show home page
/*--------------------------------------------------------------------------------------------------------------------*/
Route::get('/', 'HomeController@showHome');

// search form
Route::post('search-photo', array(
    'uses' => 'PhotoController@searchTag',
    'as' => 'search.photo'
));

/*--------------------------------------------------------------------------------------------------------------------*/
//Show tag page
/*--------------------------------------------------------------------------------------------------------------------*/
Route::get('tag/{tagName}', 'HomeController@showTagPage');

/*--------------------------------------------------------------------------------------------------------------------*/
//Show category page
/*--------------------------------------------------------------------------------------------------------------------*/
Route::get('category/{catName}', 'HomeController@showCategoryPage');

/*--------------------------------------------------------------------------------------------------------------------*/
// Show search page
/*--------------------------------------------------------------------------------------------------------------------*/
Route::get('/search/{TagName}', 'HomeController@showSearchPage');

/*--------------------------------------------------------------------------------------------------------------------*/
// Show albums page
/*--------------------------------------------------------------------------------------------------------------------*/
Route::get('/albums', 'HomeController@showAlbums');

//forms
Route::post('create-album', 'AlbumsController@createAlbum');

Route::post('show-albums', 'AlbumsController@getAlbums');

/*--------------------------------------------------------------------------------------------------------------------*/
// Show single album page
/*--------------------------------------------------------------------------------------------------------------------*/
Route::get('albums/{albumId}', 'HomeController@showSingleAlbum');

//forms
Route::post('upload-photos-to-album', 'AlbumController@uploadPhoto');
Route::post('edit-album-data', 'AlbumController@editAlbum');

//Ajax
Route::post('delete-photo', 'AlbumController@deletePhoto');
Route::post('delete-album', 'AlbumController@deleteAlbum');
Route::post('like-album', 'AlbumController@makeLike');
Route::post('comment-in-album', 'AlbumController@writeComment');

Route::post('show-album-photos', 'AlbumController@getAlbumPhotos');

//comment deleting in photo and album page
Route::post('delete-comment', 'AlbumController@deleteComment');

/*--------------------------------------------------------------------------------------------------------------------*/
// Show single photo page
/*--------------------------------------------------------------------------------------------------------------------*/
Route::get('albums/{albumId}/photo/{photoId}', 'HomeController@showSinglePhoto');

//forms
Route::post('edit-photo-data', 'PhotoController@editPhoto');

//Ajax
Route::post('like-photo', 'PhotoController@makeLike');
Route::post('comment-in-photo', 'PhotoController@writeComment');
Route::post('delete-photo-from-album', 'PhotoController@deletePhoto');

/*--------------------------------------------------------------------------------------------------------------------*/
// Show login page
/*--------------------------------------------------------------------------------------------------------------------*/
Route::get('login', 'HomeController@showLogin');

// For login AJAX query
Route::post('validate-login', array(
    'uses' => 'UserController@tryLogin',
    'as' => 'login.try'
));

//forms
Route::post('login-to-page', 'UserController@authLogin');
//logout
Route::get('logout', 'UserController@logout');

/*--------------------------------------------------------------------------------------------------------------------*/
// Show registration page
/*--------------------------------------------------------------------------------------------------------------------*/
Route::get('/registration', array(
    'uses' => 'HomeController@showRegistration',
    'as' => 'registration'
));

// AJAX query for registration validation
Route::post('validate-registration', array(
    'uses' => 'UserController@storeGet',
    'as' => 'registration.store'
));

// route for creating category
Route::post('create-category', array(
    'uses'=>'PhotoController@createCategory',
    'as' => 'create.category'
));
// route for deleting category
Route::post('delete-category', array(
    'uses'=>'PhotoController@deleteCategory',
    'as' => 'delete.category'
));
