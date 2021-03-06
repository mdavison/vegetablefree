<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@home');

Route::get('home', 'PagesController@home');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


/*
 * Users
 */
Route::resource('users', 'UsersController',
                ['except' => ['index', 'create', 'store']]);
Route::resource('admin/users', 'Admin\UsersController');


/*
 * Recipes
 */
Route::resource('recipes', 'RecipesController', ['except' => ['show']]);
// Prevent a naming clash in case recipe slug same as resource action
Route::get('recipes/view/{slug}', 'RecipesController@show');
Route::resource('admin/recipes', 'Admin\RecipesController');
Route::post('admin/recipes/approve', 'Admin\RecipesController@approve');


/*
 * Photos
 */
Route::post('photos/store', 'PhotosController@store');
Route::post('photos/remove', 'PhotosController@remove');
Route::post('photos/destroy', 'PhotosController@destroy');

Route::post('recipes/photos', 'Admin\RecipesController@photos');


/**
 * Jobs
 */
Route::get('photos/clear-temp-storage', 'PhotosController@clearTempStorage');