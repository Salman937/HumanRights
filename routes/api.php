<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'user'], function() {
    
	Route::post('register', [

		'uses' => 'Apis\UsersController@index',
		'as'   => 'register'
	]);

	Route::post('login', [

		'uses' => 'Apis\LoginController@index',
		'as'   => 'login'
	]);

	Route::group(['middleware' => 'auth:api'], function() 
	{
	    	Route::post('complaint',[

				'uses' => 'Apis\RegisterUserComplaintController@index',
				'as'   => 'complaint'
			]);

			Route::post('complaints',[

				'uses' => 'Apis\UserComplaintsController@index',
				'as'   => 'complaints'
			]);
	});
});

Route::group(['middleware' => 'auth:api'], function() 
{
		Route::post('announcements',[

			'uses' => 'Apis\AnnouncementsController@index',
			'as'   => 'announcements'
		]);
});

Route::group(['prefix' => 'categories'], function() {
    
	Route::group(['middleware' => 'auth:api'], function() 
		{
			Route::post('get',[

				'uses' => 'Apis\CategoriesController@index',
				'as'   => 'get'	
			]);

			Route::post('sub-cat',[

				'uses' => 'Apis\CategoriesController@sub_categories',
				'as'   => 'sub-cat'	
			]);
			
			Route::post('Awareness',[
			
				'uses' => 'Apis\AwarenessController@index',
				'as'   => 'Awareness'	
			
			]);
		});
});

