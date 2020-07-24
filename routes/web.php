<?php

Route::get('/', function(){
    if (\Auth::user() && \Auth::user()->hasRole("administrator"))
        return redirect()->to("/admin/dashboard");
    return redirect()->to("/user/dashboard");
});

Auth::routes(['register' => false]);

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', 'Admin\RolesController');
    Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
    Route::resource('users', 'Admin\UsersController');
    Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('dashboard', 'User\DashboardController@index')->name('dashboard');

    // Player
    Route::get('getteams', 'User\PlayerController@getteams')->name('getteams');
    Route::get('add_player', 'User\PlayerController@add_player')->name('add_player');
    Route::get('add_player_excel', 'User\PlayerController@add_player_excel')->name('add_player_excel');
    Route::get('add_player_api', 'User\PlayerController@add_player_api')->name('add_player_api');
    Route::get('get_player_list_api', 'User\PlayerController@get_player_list_api')->name('get_player_list_api');
    Route::get('get_player_list_api_data', 'User\PlayerController@get_player_list_api_data')->name('get_player_list_api_data');
    Route::get('edit_player/{player}', 'User\PlayerController@edit_player')->name('edit_player');
    Route::post('store__edt_player/{player}', 'User\PlayerController@store__edt_player')->name('store__edt_player');
    Route::post('store_player', 'User\PlayerController@store_player')->name('store_player');
    Route::get('filter_player', 'User\PlayerController@filter_player')->name('filter_player');
    Route::get('filter_show', 'User\PlayerController@filter_show')->name('filter_show');
    Route::get('player_profile/{player}', 'User\PlayerController@player_profile')->name('player_profile');

    // Setting
    Route::get('setting/paramsetting_show', 'User\SettingsController@paramsetting_show')->name('paramsetting_show');
    Route::post('setting/paramsetting_store', 'User\SettingsController@paramsetting_store')->name('paramsetting_store');

    Route::resource('leagues', 'User\LeagueController');
    Route::resource('teams', 'User\TeamController');
});
