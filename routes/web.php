<?php

use App\Models\Location;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Locates as localisCollation;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;


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

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('homeindex');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



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

route::get("/freeUser/{id}", function ($id) {
    $user = User::find($id);
    return new UserResource($user);
});


Route::get('user/{id}', 'ShowProfile');

Route::get('/token', function (Request $request) {
    $token = $request->session()->token();

    $token = csrf_token();
    echo $token;

});