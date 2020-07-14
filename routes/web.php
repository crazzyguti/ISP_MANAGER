<?php

use App\Location;
use App\Http\Resources\User as UserResource;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin', "middleware" => "role:owner"], function () {
    Route::resources([
        '/'                =>     "AdminController",
        '/category'        =>     'CategoryController',
        '/tags'            =>     'TagController',
        '/roles'           =>     'RoleController',
        '/locations'       =>     'LocationController',
        '/users'           =>     'Admin\UsersController',
        '/posts'           =>     'Admin\PostController',
        "/device"          =>     "Admin\DeviceController",
        "/customers"       =>     "CustomerController"
    ]);
});

Route::get("/maps", function () {
    $locales = Location::all();
    return view("maps.leafter", ["locales" => $locales]);
})->name("maps");

Route::get("/demo", "freeController@index");
Route::get("/free", "freeController@getServerData");
Route::get("/jsonEditor", "freeController@jsonEditor");
Route::get("/jsonEditor", "freeController@jsonEditor");
// Route::get("/free2", "freeController@getServerData");

route::get("/freeUser/{id}", function ($id) {
    $user = User::find($id);
    return new UserResource($user);
});


Route::get('user/{id}', 'ShowProfile');
