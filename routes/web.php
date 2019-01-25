<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/penulis', 'SuperController@penulis');
Route::get('/rak-buku', 'SuperController@rak_buku');
Route::get('/semua_buku', 'SuperController@buku');

Route::get('/search', 'SearchController@index');
Route::get('/filter', 'SearchController@filter');

Route::get('panduan', 'GuestController@panduan');

Route::get('/home', 'HomeController@index');
Route::get('/', 'GuestController@home');
Route::get('/homepage', 'GuestController@home');
Route::group(['prefix'=>'admin','middleware'=>['auth', 'role:admin']], function(){
	Route::resource('authors', 'AuthorsController');
	Route::resource('books', 'BooksController');
	Route::resource('places', 'PlacesController');
	Route::resource('clases', 'ClasesController');
	Route::resource('categories', 'CategoriesController');
	Route::resource('dendas', 'DendasController');
	Route::resource('members', 'MembersController');
	Route::resource('codes', 'CodesController');
	Route::resource('statistics', 'StatisticsController');
	Route::get('export/books', [
		'as'	=>'export.books',
		'uses'	=>'BooksController@export'
		]);
	Route::post('export/books', [
		'as'	=>'export.books.post',
		'uses'	=>'BooksController@exportPost'
		]);
	Route::get('template/books', [
		'as'	=>'template.books',
		'uses'	=>'BooksController@generateExcelTemplate'
		]);
	Route::get('statistics/{stat}/return', [
		'as'	=>'statistics.return',
		'uses'	=>'StatisticsController@returnBack'
		]);
	Route::post('import/books', [
		'as'	=>'import.books',
		'uses'	=>'BooksController@importExcel']);
	Route::post('import/codes', [
		'as'	=>'import.codes',
		'uses'	=>'CodesController@importExcel']);
	Route::get('template/codes', [
		'as'	=>'template.codes',
		'uses'	=>'CodesController@generateExcelTemplate'
		]);
	});

Route::put('/borrow', [
	'middleware' => ['auth', 'role:member'],
	'as' => 'guest.books.borrow',
	'uses' => 'CodesController@borrow'
]);

Route::get('books/{book}/lihat',[
	'as' => 'guest.show',
	'uses' => 'SuperController@show'
]);

Route::get('places/{place}/lihat',[
	'as' => 'guest.show_place',
	'uses' => 'SuperController@show_place'
]);

Route::get('authors/{author}/lihat',[
	'as' => 'guest.show_penulis',
	'uses' => 'SuperController@show_penulis'
]);


Route::put('books/{book}/return',[
	'as'		 => 'member.books.return',
	'uses'		 => 'CodesController@returnBack'
]);


Route::get('settings/profile/edit', 'SettingsController@editProfile');
Route::put('settings/profile', 'SettingsController@update');

Route::get('settings/password', 'SettingsController@editPassword');
Route::post('settings/password', 'SettingsController@updatePassword');
