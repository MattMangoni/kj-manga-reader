<?php

Route::any('/', 				array('uses' => 'home@index'));
Route::any('index', 			array('uses' => 'home@index'));
Route::get('edizioni',  		array('uses' => 'home@editions'));
Route::get('edizioni/(:any)',   array('uses' => 'home@editions'));
Route::get('serie',				array('uses' => 'home@series'));
Route::get('serie/(:any)', 		array('uses' => 'home@series'));
Route::get('vincitori', 		array('uses' => 'home@winners'));

Route::post('submit',			array('uses' => 'home@submit'));

// Reader
Route::get('read', 						array('uses' => 'reader@index'));
Route::get('read/(:any)', 				array('uses' => 'reader@index'));
Route::get('read/(:any)/(:any)', 		array('uses' => 'reader@index'));
Route::get('read/(:any)/(:any)/(:any)', array('uses' => 'reader@index'));

// Admin
Route::filter('pattern: admin/*', 'auth');

Route::get('admin', 		  array('before' => 'auth', 'uses' => 'admin@index'));
Route::get('admin/dashboard', array('before' => 'auth', 'uses' => 'admin@index'));
Route::controller('admin.series');
Route::controller('admin.chapters');
Route::controller('admin.editions');
Route::controller('admin.comments');

// Login/Logout
Route::any('login', array('uses' => 'admin@login'));
Route::get('logout', function() {
	if (! Auth::guest()) Auth::logout();
	return Redirect::to('login');
});

/* Events */

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/* Filters */

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});