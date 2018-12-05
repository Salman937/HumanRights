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

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('category', 'admin\CategoriesController');
	Route::resource('subcategory', 'admin\SubcategoryController');
	Route::resource('announcement', 'admin\AnnouncementController');
	Route::resource('complaint', 'admin\ComplaintsController');
	Route::resource('awareness', 'admin\AwarenessController');
	Route::resource('district', 'admin\DistrictsController');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/thirdcategory', [
		'uses' => 'admin\CategoriesController@third_category_list',
		'as' => 'third.category'
	]);
	Route::post('/get_cat', [
		'uses' => 'admin\CategoriesController@get_cat',
		'as' => 'get.cat'
	]);
	Route::post('/store/thirdcategory', [
		'uses' => 'admin\CategoriesController@thirdcategory_store',
		'as' => 'third_category.store'
	]);
	Route::get('/thirdcategory_edit/{id}', [
		'uses' => 'admin\CategoriesController@thirdcategory_edit',
		'as' => 'thirdcat.edit'
	]);
	Route::post('/thirdcategory_update/{id}', [
		'uses' => 'admin\CategoriesController@thirdcategory_update',
		'as' => 'thirdcat.update'
	]);
	Route::get('/third_category_destroy/{id}', [
		'uses' => 'admin\CategoriesController@thirdcategory_destory',
		'as' => 'thirdcat.destroy'
	]);
});

