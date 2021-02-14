<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use GuzzleHttp\Psr7\Request;
use App\Http\Controllers\imageshare\ImageContoller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\blog\PostController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', function () {
    return view('index');
});



//todo list project route
Route::get('todo/index',  'App\Http\Controllers\todo\todocontroller@getIndex');
Route::post('todo/add',  'App\Http\Controllers\todo\todocontroller@postAdd');
Route::post('todo/update/{id}',  'App\Http\Controllers\todo\todocontroller@postUpdate');
Route::get('todo/delete/{id}', 'App\Http\Controllers\todo\todocontroller@getDelete')->name('delete');
Route::get('todo/done/{id}', 'App\Http\Controllers\todo\todocontroller@getDone')->name('done');
//End todo list project route

//Image share project route


Route::get('imageshare/index','App\Http\Controllers\imageshare\ImageContoller@getIndex');

Route::get('imageshare/imageadd','App\Http\Controllers\imageshare\ImageContoller@addimage');

Route::post('add','App\Http\Controllers\imageshare\ImageContoller@postIndex')->name('store');

Route::get('imageshare/imageshow/{id}',[ImageContoller::class,'getView'])->where('id','[0-9]+');

Route::get('imageshare/deleteimage/{id}',[ImageContoller::class,'deleteimage'])->where('id','[0-9]+');
//End Image share project route

//Personal Blog route

Route::group(['prefix' => 'blog','middleware' => 'auth'], function () {

    
    Route::get('index',[PostController::class,'getIndex'] )->name('blogindex');
    Route::get('addpost',[PostController::class,'createpost'] )->name('addpost');
    Route::post('add',[PostController::class,'postAdd'] )->name('add_new_post');
    Route::get('delete/{id}',[PostController::class,'deletePost']);
    
    
});
//End Personal Blog route

// News Aggregation route
Route::controller('feeds', 'App\Http\Controllers\news\FeedsController');



