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

Route::group(['prefix' => '/'], function () {
    Route::get('/', 'HomeController@Home');
    Route::get('following', 'HomeController@Following');
    Route::get('top_stories', 'HomeController@TopStories');
    Route::get('bookmarks', 'HomeController@Bookmarks');
    Route::get('posts/new', 'StoryController@WriteStory');
    Route::post('search', 'HomeController@Search');
    Route::get('profile', 'ProfileController@Profile');
    Route::get('setting', 'ProfileController@Setting');

    Route::post('sign_up', 'MemberController@SignUp');
    Route::post('sign_in', 'MemberController@SignIn');
    Route::get('sign_out', 'MemberController@SignOut');
});

Route::group(['prefix' => '/profile/'], function() {
    Route::post('update_image', 'ProfileController@UpdateImage');
    Route::post('update_describe', 'ProfileController@UpdateDescribe');
});

Route::group(['prefix' => '/story'], function() {
    Route::get('/{id}', 'StoryController@ReadStory');
});
