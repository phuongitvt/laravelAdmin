<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
Route::middleware(['localization'])->group(function () {
    Auth::routes();
    Route::post('/lang', [
        'as' => 'switchLang',
        'uses' => 'LangController@postLang',
    ]);

    Route::middleware(['auth'])->namespace('Admin')->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/home', 'HomeController@index')->name('home');

        //member of project
        Route::get('user/index', 'UserController@index')->name('user.index');
        Route::get('user/create', 'UserController@create')->name('user.create');
        Route::post('user/createProcess', 'UserController@createProcess')->name('user.createProcess');
        Route::get('user/edit/{id}', 'UserController@edit')->name('user.edit');
        Route::post('user/update/{id}', 'UserController@update')->name('user.update');
        Route::get('user/control/{id}', 'UserController@control')->name('user.control');
        Route::post('user/updateControl/{id}', 'UserController@updateControl')->name('user.updateControl');
        Route::post('user/addMenu/{id}', 'UserController@addMenu')->name('user.addMenu');
        Route::post('user/removeMenu/{id}', 'UserController@removeMenu')->name('user.removeMenu');

        //group
        Route::get('group_menu/index', 'GroupMenuController@index')->name('group_menu.index');
        Route::get('group_menu/create', 'GroupMenuController@create')->name('group_menu.create');

        //role
        Route::get('role/index', 'RoleController@index')->name('role.index');
        Route::get('role/create', 'RoleController@create')->name('role.create');
        Route::post('role/create', 'RoleController@createProcess')->name('role.createProcess');
        Route::get('role/delete/{id}', 'RoleController@delete')->name('role.delete');
        Route::get('role/edit/{id}', 'RoleController@edit')->name('role.edit');
        Route::post('role/update/{id}', 'RoleController@update')->name('role.update');
        Route::get('role/control/{id}', 'RoleController@control')->name('role.control');
        Route::post('role/addPermission/{id}', 'RoleController@addPermission')->name('role.addPermission');
        Route::post('role/removePermission/{id}', 'RoleController@removePermission')->name('role.removePermission');

        //permission
        Route::get('permission/index', 'PermissionController@index')->name('permission.index');
        Route::get('permission/create', 'PermissionController@create')->name('permission.create');
        Route::post('permission/create', 'PermissionController@createProcess')->name('permission.createProcess');
        Route::get('permission/delete/{id}', 'PermissionController@delete')->name('permission.delete');
        Route::get('permission/edit/{id}', 'PermissionController@edit')->name('permission.edit');
        Route::post('permission/update/{id}', 'PermissionController@update')->name('permission.update');

        //slug
        Route::get('slug/index', 'SlugController@index')->name('slug.index');
        Route::get('slug/create', 'SlugController@create')->name('slug.create');
        Route::post('slug/create', 'SlugController@createProcess')->name('slug.createProcess');
        Route::get('slug/delete/{id}', 'SlugController@delete')->name('slug.delete');
        Route::get('slug/edit/{id}', 'SlugController@edit')->name('slug.edit');
        Route::post('slug/update/{id}', 'SlugController@update')->name('slug.update');
        Route::post('slug/addPermission', 'SlugController@addPermission')->name('slug.addPermission');
        Route::post('slug/removePermission', 'SlugController@removePermission')->name('slug.removePermission');

        //menu
        Route::get('menu/index', 'MenuController@index')->name('menu.index');
        Route::get('menu/create', 'MenuController@create')->name('menu.create');
        Route::post('menu/create', 'MenuController@createProcess')->name('menu.createProcess');
        Route::get('menu/delete/{id}', 'MenuController@delete')->name('menu.delete');
        Route::get('menu/edit/{id}', 'MenuController@edit')->name('menu.edit');
        Route::post('menu/update/{id}', 'MenuController@update')->name('menu.update');
    });
});


