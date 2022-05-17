<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'api/v1/users',
    'namespace' => 'Api'
], function () {

    Route::post('/auth/register',
    [
        'as' => 'auth.register',
        'uses' => 'AuthController@regregister'
    ]);

    Route::post('/auth/login',
    [
        'as' => 'auth.login',
        'uses' => 'AuthController@login'
    ]);
});

Route::group(['middleware' => 'web'], function() {

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

//Route::get('home', function()
//{
//    return View('pages.home');
//});
//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

// Route::get('/login', 'LoginController@index')->name('login');
// Route::get('/register', 'RegisterController@index')->name('register');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Registration Routes
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Auth::routes(['verify' => true]);

 Route::get('profile', function () {
     // Only verified users may enter...
 })->middleware('verified');



 Auth::routes();
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
});
