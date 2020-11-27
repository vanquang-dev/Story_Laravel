<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * --------------------------------------------------------------------------
 * ------------------------------START ADMIN---------------------------------
 * --------------------------------------------------------------------------
 */

// Hiển thị tài khoản
Route::get('/nhan-vien','AdminController@show_tk_admin');
//Thêm tài khoản
Route::post('/add-admin','AdminController@add_admin');
// Xóa tài khoản
Route::post('/delete-admin','AdminController@destroy');
// Khóa tài khoản 
Route::post('/lock-admin','AdminController@lock');
// Mở khóa
Route::post('/unlock-admin','AdminController@unlock');

/**
 * ------------------------------END ADMIN---------------------------------
 */


/**
 * --------------------------------------------------------------------------
 * ------------------------------START CATEGORY---------------------------------
 * --------------------------------------------------------------------------
 */

// Them the loai
Route::post('/add-category','CategoryController@add_category');
// Show the loai
Route::get('/show-category','CategoryController@show_category');
// Xoa the loai
Route::post('/destroy-category','CategoryController@destroy_category');

/**
 * ------------------------------END CATEGORY---------------------------------
 */


/**
 * --------------------------------------------------------------------------
 * ------------------------------START STORY---------------------------------
 * --------------------------------------------------------------------------
 */

// Them truyen
Route::post('/add-story','StoryController@add_story');
// Xoa
Route::post('/destroy-story','StoryController@destroy_story');
// Edit
Route::post('/edit-story','StoryController@edit_story');
// Them chapter
Route::post('/add-chapter','StoryController@add_chapter');

Route::get('/chapter', 'StoryController@view_chapter');

 /**
 * ------------------------------START STORY---------------------------------
 */