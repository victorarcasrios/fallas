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

/**
	ALL ALLOWED ROUTES
*/
Route::get('/', function(){
	return redirect()->route('index');
});
// Route::get('fallas/top/{$records}', 'FallasController@getWorstFallas');	

Route::group(['prefix' => 'fallas'], function(){
	Route::get('/search', 'FallasController@displaySearchForm');
	Route::post('/search', 'FallasController@search');
	Route::get('/top', ['as' => 'index', 'uses' => 'FallasController@displayShamefulnessList']);
});

Route::get('/objections', ['as' => 'moansIndex', 'uses' => 'ObjectionsController@displayMoansList']);

/**
	ONLY LOGGED USERS
*/
Route::group(['middleware' => 'onlyLoggedUser'], function(){
	Route::get('users/exit', 'UsersController@logout');
	Route::get('fallas/{idFalla}/objections/form', function($idFalla){
		return redirect()->route('moansForm')->with('idFalla', $idFalla);
	});

	Route::group(['prefix' => 'fallas'], function(){
		Route::get('/', 'FallasController@displayForm');
		Route::post('/', 'FallasController@create');
	});

	Route::group(['prefix' => 'objections'], function(){
		Route::get('/form', ['as' => 'moansForm', 'uses' => 'ObjectionsController@displayMoansForm']);
		Route::post('/', 'ObjectionsController@createMoan');
	});
});

/**
	ONLY GUEST USERS
*/
Route::group(['middleware' => 'onlyGuest'], function(){

	Route::group(['prefix' => 'users'], function(){
		Route::get('/', 'UsersController@displayForm');
		Route::post('/', 'UsersController@submitForm');
		Route::get('/{id}/activation/{token}', 'UsersController@activate');
		
		Route::group(['prefix' => 'access'], function(){
			Route::get('/', 'UsersController@displayLogin');
			Route::post('/', 'UsersController@login');
		});
	});
	
});


// Route::get('home', 'HomeController@index');

// Route::controllers([
// 	'auth' => 'Auth\AuthController',
// 	'password' => 'Auth\PasswordController',
// ]);
