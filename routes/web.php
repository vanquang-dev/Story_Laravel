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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'filemanager', 'middleware' => 'App\Http\Middleware\CheckLoggedAdmin'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::get('/home', 'StoryController@show_home')->middleware('App\Http\Middleware\CheckLoggedAdmin')->name('home');

/**
 * -------------------------------------------------------------------------------
 * ------------------------------ START ADMIN--------------------------------------
 * -------------------------------------------------------------------------------
 */
Route::group(['middleware' => 'App\Http\Middleware\CheckAdmin'], function () {
    // Show
    Route::get('/quan-tri-vien', function() {
        return view('admin.show_admin');
    });
});
/**
 * ------------------------------ END ADMIN--------------------------------------
 */

/**
 * --------------------------------------------------------------------------
 * ------------------------------START STORY---------------------------------
 * --------------------------------------------------------------------------
 */
Route::group(['middleware' => 'App\Http\Middleware\CheckLoggedAdmin'], function () {
    //Show them the loai
    Route::get('/them-the-loai', 'CategoryController@category');
    // Them truyen
    Route::get('/them-truyen', 'StoryController@show_add_story');
    // Show
    Route::get('/truyen', 'StoryController@story')->name('all-story');
    // Tim kiem
    Route::get('/tim-truyen','StoryController@search');
    // Update
    Route::get('/truyen/edit/{story_id}', 'StoryController@show_edit_story');
    // Them chapter
    Route::get('/truyen-{story_id}/add-chapter', function($story_id) {
        return view('admin.add_chapter', ['story_id' => $story_id]);
    });
    // Xem truyen
    Route::get('/truyen-{story_id}/full', 'StoryController@show_chapter');
    // Doc truyen
    Route::get('/truyen-{story_id}/{id}-chapter-{chapter}.html', function($story_id, $id, $chapter) {
        return view('admin.view_chapter', ['story_id'=> $story_id, 'id' => $id, 'chapter'=> $chapter]);
    });
    
});

/**
 * ------------------------------ END STORY--------------------------------------
 */

//show trang dang nhap
Route::get('/login-admin', function(){
    return view('admin.login');
})->middleware('App\Http\Middleware\CheckLoginAdmin')->name('login-admin');

//Dang nhap
Route::post('/login-admin', 'AdminController@Login');

//Dang xuat
Route::get('/logout','AdminController@Logout');
