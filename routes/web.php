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

Route::get('/', 'MainHomeController@index');

Auth::routes();
Route::get('/home', 'HomeController@index');
Route::get('admin-area/logout', 'HomeController@adminlogout');
Route::get('business/logout', 'HomeController@businesslogout');
Route::get('customer/logout', 'HomeController@customerlogout');
Route::get('admin-area', 'HomeController@index');
Route::get('admin-area', function(){
    return view('auth/login');
});
Route::get('admin-area/login', function(){
    return view('auth/login');
});
Route::get('admin-area/register', function(){
    return view('auth/register');
});
Route::get('privacy', function(){
    return view('privacy', array('title' => 'Privacy Policy'));
});
Route::get('terms', function(){
    return view('terms', array('title' => 'Terms and Conditions'));
});
Route::get('contact', function(){
    return view('contact', array('title' => 'Contact to Us'));
});

Route::prefix('business')->group(function (){
    Route::get('/', 'BusinessController@index');
    Route::get('/dashboard', 'BusinessController@dashboard');
    Route::get('/packages', 'BusinessController@package');
    Route::get('/packages/{name}', 'BusinessController@setpackage');
    Route::get('/cancelpackages', 'BusinessController@package');
    Route::get('/advertising', 'BusinessController@advertising');
    Route::get('/weeklyemail', 'BusinessController@weeklyemail');
    Route::post('/savebusiness', 'BusinessController@savebusiness');
    Route::get('/info/{id}', 'MainHomeController@getBusiness');
    Route::get('/profile', 'BusinessController@profile');
    Route::post('/saveprofile', 'BusinessController@saveprofile');
    Route::post('/resetprofile', 'BusinessController@resetprofile');
});

Route::prefix('category')->group(function (){
    Route::get('/', 'MainHomeController@displayCategory');
    Route::post('search', 'MainHomeController@searchCategroy');

});
