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
    Route::post('posts/new', 'StoryController@InsertStory');
    Route::post('search', 'HomeController@Search');
    Route::get('profile', 'ProfileController@Profile');
    Route::get('setting', 'ProfileController@Setting');
    Route::post('update_password', 'ProfileController@UpdatePassword');
    Route::get('my_stories', 'ProfileController@MyStories');
    Route::get('update_story/{id}', 'ProfileController@GetUpdateStory');
    Route::post('update_story/{id}', 'ProfileController@PostUpdateStory');
    Route::post('posts/comment/{id}', 'StoryController@PostComment');

    Route::post('sign_up', 'MemberController@SignUp');
    Route::post('sign_in', 'MemberController@SignIn');
    Route::get('sign_out', 'MemberController@SignOut');
});

Route::group(['prefix' => '/profile/'], function() {
    Route::post('update_image', 'ProfileController@UpdateImage');
    Route::post('update_cover', 'ProfileController@UpdateCover');
    Route::post('update_describe', 'ProfileController@UpdateDescribe');
});

Route::group(['prefix' => '/story'], function() {
    Route::get('/{id}', 'StoryController@ReadStory');
});

Route::post('like_story/{id}/{member_id}', 'StoryController@LikeStory');


