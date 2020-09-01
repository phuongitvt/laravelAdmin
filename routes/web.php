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
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    //member of project
    Route::get('member/index', 'MemberController@index')->name('member.index');
    Route::get('member/create', 'MemberController@create')->name('member.create');

    //group menu
    Route::get('group_menu/index', 'GroupMenuController@index')->name('group_menu.index');
    Route::get('group_menu/create', 'GroupMenuController@create')->name('group_menu.create');

    //role menu
    Route::get('role/index', 'RoleController@index')->name('role.index');
    Route::get('role/create', 'RoleController@create')->name('role.create');

    //permission menu
    Route::get('permission/index', 'PermissionController@index')->name('permission.index');
    Route::get('permission/create', 'PermissionController@create')->name('permission.create');

    //permission menu
    Route::get('menu/index', 'MenuController@index')->name('menu.index');
    Route::get('menu/create', 'MenuController@create')->name('menu.create');
    Route::post('menu/create', 'MenuController@createProcess')->name('menu.createProcess');
});


