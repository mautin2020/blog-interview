<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//public route
Route::post('userRegistration', 'App\Http\Controllers\User\AddUserController@UserRegistration');
Route::post('login', 'App\Http\Controllers\LoginController@login');
Route::post('viewPost', 'App\Http\Controllers\Blog\BlogPostController@index');

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post('logout', 'App\Http\Controllers\LoginController@logout');
    Route::post('createBlog', 'App\Http\Controllers\Blog\BlogPostController@createBlog');
    Route::put('updateBlog/{id}', 'App\Http\Controllers\Blog\BlogPostController@updateBlog');
    Route::delete('deleteBlog/{id}', 'App\Http\Controllers\Blog\BlogPostController@deleteBlog');
});