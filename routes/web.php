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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/contact', 'ContactController@index');
Route::get('privacy', function(){
   return view('front/privacy', array('title' => 'Privacy Policy'));
});
Route::get('terms', function(){
    return view('front/terms', array('title' => 'Terms and Conditions'));
});

//Route::get('dashboard', function(){
//    return view('dashboard', array('title' => 'Dashboard'));
//});
Route::get('dashboard', 'DashboardController@index');

Route::get('business', 'BusinessController@index');
Route::post('business/savebusiness', 'BusinessController@savebusiness');
Route::get('business/info/{id}', 'HomeController@getBusiness');
Route::post('business/postReview', 'BusinessController@saveReview');

Route::get('packages', 'PackagesController@index');

Route::get('profile', 'ProfileController@index');
Route::prefix('profile')->group(function(){
    Route::post('uploadfile', 'ProfileController@uploadfile');
    Route::post('saveprofile', 'ProfileController@saveprofile');
    Route::post('resetpwd', 'ProfileController@resetpwd');
});

Route::get('message', 'MessageController@index');

Route::get('project', 'ProjectController@index');

Route::get('active', 'ActiveController@index');

Route::get('pending', 'PendingController@index');

Route::get('completed', 'CompletedController@index');