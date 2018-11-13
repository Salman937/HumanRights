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

	Route::post('verify-account', [

		'uses' => 'Apis\UsersController@verify_account',
		'as'   => 'verify-account'
	]);

	Route::post('forgot-password', [

		'uses' => 'Apis\UsersController@forgot_password',
		'as'   => 'forgot-password'
	]);

	Route::post('verify-forgot-password', [

		'uses' => 'Apis\UsersController@verify_forgot_password',
		'as'   => 'verify-forgot-password'
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

			Route::post('user_profile',[
				'uses' => 'Apis\ProfileController@show',
				'as'   => 'user_profile'
			]);

			Route::post('update_user_profile',[
				'uses' => 'Apis\ProfileController@update',
				'as'   => 'update_user_profile'
			]);
	});
});

Route::group(['middleware' => 'auth:api'], function() 
{
		Route::post('announcements',[

			'uses' => 'Apis\AnnouncementsController@index',
			'as'   => 'announcements'
		]);
		Route::post('phone_dir',[

			'uses' => 'Apis\PhoneDirController@index',
			'as'   => 'phone_dir'
		]);
});

Route::group(['prefix' => 'categories'], function() {
    
	Route::group(['middleware' => 'auth:api'], function() 
		{
			Route::get('districts',[

				'uses' => 'Apis\CategoriesController@districts',
				'as'   => 'districts'	
			]);
			
			Route::post('Awareness',[
			
				'uses' => 'Apis\AwarenessController@index',
				'as'   => 'Awareness'	
			
			]);
		});
		
	Route::post('get',[

		'uses' => 'Apis\CategoriesController@index',
		'as'   => 'get'	
	]);

	Route::post('sub-cat',[

		'uses' => 'Apis\CategoriesController@sub_categories',
		'as'   => 'sub-cat'	
	]);

	Route::post('thrid-category',[

		'uses' => 'Apis\CategoriesController@thrid_category',
		'as'   => 'thrid-category'	
	]);
});

Route::get('test-notification',[
			
	'uses' => 'Apis\RegisterUserComplaintController@testing_notification',
	'as'   => 'test-notification'	

]);

