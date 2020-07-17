<?php

use Illuminate\Support\Facades\Route;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('/dashboard', 'Backend\DashboardController@index')->name('dashboard');
Route::post('/locale', 'UtilityController@changeLocale');
Route::get('/article/list', 'Backend\ArticleController@list');
Route::get('/article/show', 'Backend\ArticleController@showAll');
Route::post('/article/add', 'Backend\ArticleController@add');
Route::post('/article/image/upload', 'Backend\ArticleController@imageUpload');
Route::get('/article/new', 'Backend\ArticleController@addNew');
Route::post('/article/update', 'Backend\ArticleController@update');
Route::post('/article/delete', 'Backend\ArticleController@delete');
Route::get('/article/chart', 'Backend\ArticleController@chart');

Route::get('/storage/{any}/{filepath}', 'UtilityController@getResource');
