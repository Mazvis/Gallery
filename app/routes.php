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

Route::post('getUserByStr','UserController@usersNamesByStr');
Route::post('checkOrUserExists','UserController@checkOrUserExists');

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

// AJAX query for user settings changing
Route::post('validate-settings', array(
    'uses' => 'UserController@changeSettings',
    'as' => 'user.settings'
));

// AJAX query for user role changing
Route::post('validate-roles', array(
    'uses' => 'UserController@changeUserRole',
    'as' => 'user.roles'
));

// AJAX query for user role changing
Route::post('subscribe', array(
    'uses' => 'UserController@subscribe',
    'as' => 'user.subscribe'
));

/*--------------------------------------------------------------------------------------------------------------------*/
// Show user profile page
/*--------------------------------------------------------------------------------------------------------------------*/
Route::get('/profile', 'HomeController@showProfile');

// model for user profile data editing
Route::model('user', 'User');
Route::post('profile/update/name/{user}', array(
    'uses'=>'ProfileController@profileNamePost',
    'as' => 'user.update.name'
));
Route::post('profile/update/email/{user}', array(
    'uses'=>'ProfileController@profileEmailPost',
    'as' => 'user.update.email'
));
Route::post('profile/update/password/{user}', array(
    'uses'=>'ProfileController@profilePasswordPost',
    'as' => 'user.update.password'
));

/*--------------------------------------------------------------------------------------------------------------------*/
// Show single user profile page
/*--------------------------------------------------------------------------------------------------------------------*/
Route::get('user/{username}', 'HomeController@showUserProfile');

/*--------------------------------------------------------------------------------------------------------------------*/
// Show admin panel page
/*--------------------------------------------------------------------------------------------------------------------*/
Route::get('panel', 'HomeController@showPanel');

Route::get('mysubscribtions', 'UserController@showMySubscribtions');
Route::post('mysubscribtions', array(
    'uses'=>'UserController@showMySubscribtionsUser',
    'as' => 'user.mysubscribtions'
));
Route::resource('mysubscribtions', 'UserController');
Route::get('api/mysubscribtions', array('as'=>'api.mysubscribtions', 'uses'=>'UserController@getMySubscribtionsUserDatatable'));

Route::get('searches', 'AdminController@showSearches');
Route::resource('searches', 'AdminController');
Route::get('api/searches', array('as'=>'api.searches', 'uses'=>'AdminController@getSearchesDatatable'));

Route::get('logins', 'AdminController@showLogins');
Route::post('logins', 'AdminController@showLogins');
Route::resource('logins', 'AdminController');
Route::get('api/logins', array('as'=>'api.logins', 'uses'=>'AdminController@getLoginsDatatable'));


Route::get('myactions', 'UserController@showMyActions');
Route::resource('myactions', 'UserController');
Route::get('api/myactions', array('as'=>'api.myactions', 'uses'=>'UserController@getMyActionsDatatable'));

Route::get('useractions', 'AdminController@showUserActions');
Route::post('useractions', 'AdminController@showUserActions');
Route::resource('useractions', 'AdminController');
Route::get('api/useractions', array('as'=>'api.useractions', 'uses'=>'AdminController@getUserActionsDatatable'));

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

/*--------------------------------------------------------------------------------------------------------------------*/
// Show not found page
/*--------------------------------------------------------------------------------------------------------------------*/
Route::get('/404', 'HomeController@showNotFoundPage');