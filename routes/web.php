<?php

use App\Location;
use App\Http\Resources\UserCollection as UserCollection;
use App\Http\Resources\Locates as localisCollation;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\User;

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


Route::group(['prefix' => 'admin', "middleware" => "role:super-admin"], function () {
    Route::resources([
        '/'                =>     "AdminController",
        '/category'        =>     'CategoryController',
        '/tags'            =>     'TagController',
        '/roles'           =>     'RoleController',
        '/locations'       =>     'LocationController',
        '/users'           =>     'Admin\UsersController',
        '/posts'           =>     'Admin\PostController',
        "/device"          =>     "Admin\DeviceController"
    ]);
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::get("/maps", function () {
    $locales = Location::all();
    return view("maps.leafter", ["locales" => $locales]);
});

Route::get("/demo", "freeController@getServerData");
