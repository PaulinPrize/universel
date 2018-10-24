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

Route::group(['middleware' => 'revalidate'], function(){
	Route::middleware(['auth'])->group(function(){
		// Rôles
		Route::post('role/store','RoleController@store')->name('role.store')
		->middleware('permission:role.create');

		Route::get('role','RoleController@index')->name('role.index')
		->middleware('permission:role.index');

		Route::get('role/create','RoleController@create')->name('role.create')
		->middleware('permission:role.create');
		
		Route::put('role/update/{id}','RoleController@update')->name('role.update')
		->middleware('permission:role.edit');

		Route::get('role/{id}/edit','RoleController@edit')->name('role.edit')
		->middleware('permission:role.edit');

		Route::get('role/show/{id}','RoleController@show')->name('role.show')
		->middleware('permission:role.show');	

		Route::delete('role/destroy/{id}','RoleController@destroy')->name('role.destroy')
		->middleware('permission:role.destroy');	

		Route::put('role.update/{id}','RoleController@update')->name('role.update')
		->middleware('permission:role.edit');

		// Utilisateurs
		Route::get('tableau-de-bord', 'UserController@accueilUser')->name('tableau-de-bord')
		->middleware('permission:user.tableau-de-bord');

		Route::post('/updateImage','ImageController@updateCouverture')->name('updateImage');

		Route::get('user','UserController@index')->name('user.index')
		->middleware('permission:user.index');

		Route::get('user/create','UserController@create')->name('user.create')
		->middleware('permission:user.create');

		Route::delete('user/destroy/{id}','UserController@destroy')->name('user.destroy')
		->middleware('permission:user.destroy');

		Route::post('user/store','UserController@store')->name('user.store')
		->middleware('permission:user.create');

		Route::get('user/show/{id}','UserController@show')->name('user.show')
		->middleware('permission:user.show');

		Route::get('user/{id}/edit','UserController@edit')->name('user.edit')
		->middleware('permission:user.edit');

		Route::put('user/update/{id}','UserController@update')->name('user.update')
		->middleware('permission:user.edit');

		Route::get('profil', 'UserController@profil')->name('profil')
		->middleware('permission:profil');

		Route::get('password','UserController@changePassword')->name('password')
		->middleware('permission:password');
	});
	
});

	
/* Envoi e-mail de confirmation de compte */
Route::name('auth.resend_confirmation')->get('/register/confirm/resend', 'Auth\RegisterController@resendConfirmation');
Route::name('auth.confirm')->get('/register/confirm/{confirmation_code}', 'Auth\RegisterController@confirm');

