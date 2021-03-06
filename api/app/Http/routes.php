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

Route::post('user/auth', 'UserController@authenticate');
Route::post('user/activate', 'UserController@activate');
Route::post('user/validation/email', 'UserValidationController@email');

/*
 * Visual Captcha routes
 */
Route::get('/start/{numberOfOptions}', 'CaptchaController@generate');
Route::get('/image/{index}', 'CaptchaController@streamImage');
Route::get('/audio', 'CaptchaController@streamAudio');
Route::post('/try', 'CaptchaController@validateCaptcha');



Route::resource('user','UserController', ['only' => ['store', 'index']]);

Route::group(['middleware' => ['auth']], function()
{
	Route::post('user/validation/password', 'UserValidationController@password');
	Route::post('user/search', 'UserController@search');
	Route::get('user/logout', 'UserController@logout');
	Route::resource('user.wingnote', 'WingNoteController');
	Route::resource('user/invitation', 'InvitationController');
	Route::resource('user/file', 'UserFileController');
	Route::resource('user/profil', 'ProfilController');
	Route::resource('user.photos', 'PhotosController');
	Route::resource('user','UserController', ['except' => ['store', 'index']]);	
	
});


Route::controllers([
	'password' => 'Auth\PasswordController',
]);
