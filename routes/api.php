<?php

use App\Http\Controllers\Api\MasterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function () {
    Route::group(['middleware' => ['auth:api']], function () {
        // Route::apiResource('place', 'MasterPointController');
        Route::get('nailsjobs', 'NailsJobsController@index')->name('nailsjobs.index');
        Route::get('master/{master}', 'MasterController@show')->name('master.show');
        Route::post('userProfile', 'UserController@profileUser')->name('user.profile');
        Route::apiResource('admin', 'AdminController');
        Route::get('storage/{file}', 'FileController@fileStorageServe')
        ->where(['file' => '.*'])->name('storage.gallery.file');
        // Route::post('master', [MasterController::class, 'store'])->name('masterstore');
        // Route::apiResource('master', 'MasterController');
    });
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('register', 'RegisterController');
        Route::post('login', 'LoginController');
        Route::post('loginadmin', 'LoginAdminController');
        Route::post('logout', 'LogoutController')->middleware('auth:api');
    });
});
