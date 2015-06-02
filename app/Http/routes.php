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

Route::resource('users', 'UsersController',
                ['except' => ['index', 'create', 'store']]);

Route::resource('recipes', 'RecipesController');

Route::resource('admin/users', 'Admin\UsersController');

Route::resource('admin/recipes', 'Admin\RecipesController');

Route::post('admin/recipes/approve', 'Admin\RecipesController@approve');

Route::post('photos/store', 'PhotosController@store');

Route::post('photos/remove', 'PhotosController@remove');