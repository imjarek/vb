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
// закомментировать
Route::get('/phpinfo', function() {return phpinfo();});

Route::post('callback_api/vk', 'CallBack\VkCallBackController@index')->name('callback_api.vk');
Route::post('callback_api/bw', 'CallBack\BwCallBackController@index')->name('callback_api.bw');

Route::post('bw_user_logged_in', 'BwUsersController@updateUser');

Route::group(['middleware' => 'auth'], function () {
    Route::post('sidebar_toggle', 'ProfileController@sidebarToggle')->name('ajax.sidebarToggle');
    Route::post('upload/tmp/image', 'MediaController@uploadTmpImage')->name('upload.tmp.image');
});


Route::group(['middleware' => ['localizationRedirect'], 'prefix' => LaravelLocalization::setLocale()], function () {

    Auth::routes();

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/', 'HomeController@index')->name('home');

        Route::get('bots/vk', 'VK\VkBotController@index')->name('bots.vk');
        Route::get('bots/vk/create', 'VK\VkBotController@create')->name('bots.vk.create');
        Route::get('bots/vk/edit/{id}', 'VK\VkBotController@edit')->name('bots.vk.edit');
        Route::post('bots/vk/save/{id?}', 'VK\VkBotController@save')->name('bots.vk.save');
        Route::get('bots/vk/test/{id}', 'VK\VkBotController@test')->name('bots.vk.test');
        Route::post('bots/vk/remove/{id}', 'VK\VkBotController@removeInTrash')->name('bots.vk.remove_in_trash');

        Route::get('bots/vk/{id_bot}/list_command', 'VK\VkCommandController@listCommands')->name('bots.vk.list_command');
        Route::get('bots/vk/{id_bot}/user_c/{id_com?}', 'VK\VkCommandController@formCommand')->name('bots.vk.user_command');
        Route::get('bots/vk/{id_bot}/sys_c/{id_com?}', 'VK\VkCommandController@formCommand')->name('bots.vk.sys_command');
        Route::get('bots/vk/{id_bot}/bw_c/{id_com?}', 'VK\VkCommandController@formCommand')->name('bots.vk.bw_command');
        Route::post('bots/vk/{id_bot}/command/{id_com?}/save', 'VK\VkCommandController@saveCommand')->name('bots.vk.save_command');
        Route::post('bots/command/{id_com}/remove', 'VK\VkCommandController@removeCommand')->name('bots.command.remove');

        Route::get('profile', 'ProfileController@profile')->name('profile');
        Route::post('profile', 'ProfileController@updateProfile')->name('profile.update');
        Route::post('profile/change_password', 'ProfileController@changePassword')->name('profile.update.password');
        Route::post('profile/update_logo', 'ProfileController@updateLogo')->name('profile.update.logo');

        Route::group(['middleware' => 'admin'], function(){
            Route::any('users', 'UsersController@allUsers')->name('users');
            Route::any('users/new', 'UsersController@newUsers')->name('users.new');
            Route::any('users/active', 'UsersController@activeUsers')->name('users.active');
            Route::any('users/blocked', 'UsersController@blockedUsers')->name('users.blocked');
            Route::any('users/admin', 'UsersController@adminUsers')->name('users.admin');
            Route::post('users/update', 'UsersController@updateUser')->name('users.update');

            Route::get('bots/vk/trash', 'VK\VkBotController@trash')->name('admin.bots.vk.trash');
            Route::post('bots/vk/restore/{id}', 'VK\VkBotController@restore')->name('admin.bots.vk.restore');
            Route::post('bots/vk/force_remove/{id}', 'VK\VkBotController@removeWithTrash')->name('admin.bots.vk.remove_with_trash');
        });
    });

});
