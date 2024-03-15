<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\LevelController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\TaskController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group([
    'middleware' => ['api'],
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
    Route::get('user/normal', [AuthController::class, 'GetUserNormal']);
});



Route::group([
    'middleware' => ['api'],
    'prefix' => 'v1'
], function ($router) {
    // Projects
    Route::resource('projects', ProjectController::class)->only([
        'index', 'show', 'store', 'destroy', 'update'
    ]);;

    //Tasks
    Route::resource('tasks', TaskController::class)->only([
        'index', 'show', 'store', 'destroy', 'update'
    ]);;
    Route::get('tasks/list/{id}', [TaskController::class, 'GetTaskInfo']);

    // Upload Images
    Route::post('images/upload', [ImageController::class, 'StoreImage']);
    Route::get('images/{fileName}', [ImageController::class, 'ShowImage'])->name('image.show');

    // Categories
    Route::resource('categories', CategoryController::class)->only([
        'index'
    ]);

    // Level
    Route::resource('levels', LevelController::class)->only([
        'index'
    ]);
});

