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

// Route::get('/', ['as' => 'home', 'uses' => 'ArticleController@index']);

// Route::get('post/{slug}', ['as' => 'post.show', 'uses' => 'ArticleController@show']);

// Route::get(trans('routes.about'), ['as' => 'about', 'uses' => 'PageController@getAboutPage']);

// Route::get('lang/{language}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

Auth::routes();
// Route::get('logout', 'Auth\LoginController@logout');
Route::get('/{any}', 'SpaController@index')->where('any', '.*');
