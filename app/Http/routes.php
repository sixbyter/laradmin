<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => [
    'CheckForMaintenanceMode',
    'EncryptCookies',
    'AddQueuedCookiesToResponse',
    'StartSession',
    'ShareErrorsFromSession',
    'ShareMessageFromSession',
    'csrf',
]], function () {

    Route::controllers([
        'auth'     => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);

    Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard', 'middleware' => ['auth', 'perchecker']], function () {

        Route::get('/', function () {
            return redirect()->route('dashboard.welcome');
        });
        Route::get('/welcome', [
            'uses' => 'DashboardController@welcome',
            'as'   => 'dashboard.welcome',
        ]);
        // dashboard route
        Route::post('user/{userid}/sync', [
            'uses' => 'UserController@sync',
            'as'   => 'dashboard.user.sync',
        ]);
        Route::resource('user', 'UserController');
        Route::resource('permission', 'PermissionController');
        Route::post('role/{roleid}/sync', [
            'uses' => 'RoleController@sync',
            'as'   => 'dashboard.role.sync',
        ]);
        Route::resource('role', 'RoleController');
        Route::get('route-permission/sync', [
            'uses' => 'RoutePermissionController@sync',
            'as'   => 'dashboard.route-permission.sync',
        ]);
        Route::resource('route-permission', 'RoutePermissionController');
    });

});

Route::group(['middleware' => [
    'CheckForMaintenanceMode',
    'EncryptCookies',
    'AddQueuedCookiesToResponse',
    'StartSession',
]], function () {
    Route::group(['namespace' => 'Home'], function () {
        // home route
    });
});

Route::group(['middleware' => [
    'CheckForMaintenanceMode',
]], function () {
    Route::group(['namespace' => 'Resource', 'prefix' => 'api'], function () {

        // api route
    });

});
