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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::post('/subscriber','SubscriberController@store')->name('subscriber.store');

Route::group(['as'=>'admin.', 'prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth','admin'] ], function()
{
	Route::get('dashboard','DashboardController@index')->name('dashboard');

	Route::resource('tag','TagController');
	Route::resource('category','CategoryController');
	Route::resource('post','PostController');

	Route::put('/post/{id}/approve', 'PostController@approval')->name('post.approve');
	Route::get('/pending/post', 'PostController@pending')->name('post.pending');

	// subscriber routes
	Route::get('/subscriber','SubscriberController@index')->name('subscriber.index');
	Route::delete('/subscriber/{id}','SubscriberController@destroy')->name('subscriber.destroy');

	//settings
	Route::get('/settings', 'SettingsController@index')->name('settings.index');
	Route::put('/settings/profile-update', 'SettingsController@profileUpdate')->name('settings.profile-update');

});

Route::group(['as'=>'user.', 'prefix'=>'user', 'namespace'=>'User', 'middleware'=>['auth','user'] ], function()
{
	Route::get('dashboard','DashboardController@index')->name('dashboard');
	Route::resource('post','PostController');
});

