<?php

Route::get('administrator', 'AdminController@Login')->name('administrator');
Route::post('auth/administrator', 'AdminController@AuthAdmin');

Route::group(['middleware' => 'AuthAdmin'], function() {

    Route::group(['prefix' => 'admin'], function() {
        Route::get('logout', 'AdminController@Logout');
        Route::get('main', 'AdminController@Main');

        Route::group(['prefix' => 'member'], function() {
            Route::get('send_message', 'ManageMember@SendMessage');
            Route::get('permission', 'ManageMember@Permission');
        });

        Route::group(['prefix' => 'permission'], function() {
            Route::get('temporary_suspend/confirm/{member_id}', 'ManageMember@TemporarySuspendConfirm');
            Route::get('temporary_suspend/cancel/{member_id}', 'ManageMember@TemporarySuspendCancel');
            Route::get('suspended/confirm/{member_id}', 'ManageMember@SuspendedConfirm');
            Route::get('suspended/cancel/{member_id}', 'ManageMember@SuspendedCancel');
        });

        Route::group(['prefix' => 'edit'], function() {
            Route::get('tags_story', 'EditController@TagsStory');
            Route::post('tags_story/update', 'EditController@UpdateTagsStory');
            Route::get('editor_pick', 'EditController@EditorPick');
            Route::post('editor_pick/update', 'EditController@UpdateEditorPick');
            Route::get('knowledge', 'EditController@Knowledge');
            Route::post('knowledge/insert', 'EditController@InsertKnowledge');
            Route::post('knowledge/sort/update/{id}', 'EditController@UpdateSortKnowledge');
            Route::get('knowledge/sort/delete/{id}', 'EditController@DeleteSortKnowledge');
            Route::get('contact', 'EditController@Contact');
            Route::post('contact', 'EditController@UpdateContact');
            Route::get('pin_story', 'EditController@PinStory');
            Route::post('pin_story/update', 'EditController@UpdatePinStory');
            Route::get('pin_story/disable/{id}', 'EditController@DisablePinStory');
            Route::get('pin_story_tag', 'EditController@PinStoryTag');
            Route::post('pin_story_tag/update/{id}', 'EditController@UpdatePinStoryTag');
        });

        Route::group(['prefix' => 'report'], function() {
            Route::get('follows', 'ReportController@Follows');
            Route::get('story_likes', 'ReportController@StoryLikes');
        });

    });

});

Route::get('/', 'HomeController@Home')->name('/');
Route::post('sign_in', 'MemberController@SignIn');
Route::post('sign_up', 'MemberController@SignUp');

Route::group(['middleware' => 'AuthMember'], function() {

    Route::group(['prefix' => '/'], function () {
//        Route::get('/', 'HomeController@Home');
        Route::get('following/users', 'HomeController@FollowingUsers');
        Route::get('following/tags', 'HomeController@FollowingTags');
        Route::get('top_stories', 'HomeController@TopStories');
        Route::get('bookmarks', 'HomeController@Bookmarks');
        Route::get('posts/new', 'StoryController@WriteStory');
        Route::post('posts/new', 'StoryController@InsertStory');
        Route::get('search/{keyword}', 'HomeController@Search');
        Route::get('profile', 'ProfileController@Profile');
        Route::get('profile/user/{id}', 'ProfileController@UserProfile');
        Route::get('setting', 'ProfileController@SettingMember');
        Route::post('setting/update/new_sletter', 'ProfileController@UpdateNewsletter');
        Route::post('update_password', 'ProfileController@UpdatePassword');
        Route::get('my_stories', 'ProfileController@MyStories');
        Route::get('update_story/{id}', 'ProfileController@GetUpdateStory');
        Route::post('update_story/{id}', 'ProfileController@PostUpdateStory');
        Route::post('posts/comment/{id}', 'StoryController@PostComment');
        Route::post('follow/{id}', 'ProfileController@Follow');
        Route::post('unfollow/{id}', 'ProfileController@Unfollow');


        Route::get('sign_out', 'MemberController@SignOut');

        Route::get('contact', 'HomeController@Contact');

        Route::post('notification/check', 'HomeController@NotificationCheck');

        Route::group(['prefix' => 'tag'], function() {
            Route::get('{id}', 'HomeController@Tag'); // Normal
            Route::get('sort/like/{id}', 'HomeController@TagSortByLike'); // Sort by like
            Route::post('follow/{id}', 'ProfileController@TagFollow');
            Route::post('unfollow/{id}', 'ProfileController@TagUnfollow');
        });
    });

    Route::group(['prefix' => 'list'], function() {
        Route::get('followers/{id}', 'ProfileController@ListFollowers');
        Route::get('tag_following/{id}', 'ProfileController@ListTagFollowing');
    });

    Route::group(['prefix' => '/profile'], function() {
        Route::post('update_image', 'ProfileController@UpdateImage');
        Route::post('update_cover', 'ProfileController@UpdateCover');
        Route::post('update_describe', 'ProfileController@UpdateDescribe');
    });

    Route::group(['prefix' => '/story'], function() {
        Route::get('/{id}', 'StoryController@ReadStory');
    });

    Route::post('like_story/{id}/{member_id}', 'StoryController@LikeStory');

});


