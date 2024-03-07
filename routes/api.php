<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\LevelController;
use App\Http\Controllers\API\PriorityController;
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
    'prefix' => 'project'
], function ($router) {
    Route::get('/', [ProjectController::class, 'GetProjectInfo']);
    Route::post('/add', [ProjectController::class, 'CreateProject']);
    Route::delete('/delete/{id}', [ProjectController::class, 'DeleteProjectByID']);
    Route::get('/view/{id}', [ProjectController::class, 'GetProjectInfoByID']);
    Route::post('/update', [ProjectController::class, 'UpdateProject']);
});


Route::group([
    'middleware' => ['api'],
    'prefix' => 'task'
], function ($router) {
    Route::get('{id}', [TaskController::class, 'GetTaskInfo']);
    Route::post('add', [TaskController::class, 'CreateTask']);
    Route::get('info/{id}', [TaskController::class, 'GetTaskInfoById']);
    Route::delete('delete/{id}', [TaskController::class, 'DeleteTaskByID']);
    Route::post('update', [TaskController::class, 'UpdateTask']);
    Route::post('level/update', [TaskController::class, 'UpdateLevelTask']);

});


Route::group([
    'middleware' => ['api'],
    'prefix' => 'images'
], function ($router) {
    Route::post('upload', [ImageController::class, 'StoreImage']);
    Route::get('{fileName}', [ImageController::class, 'ShowImage'])->name('image.show');
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'category'
], function ($router) {
    Route::get('', [CategoryController::class, 'GetCategoryInfo']);
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'level'
], function ($router) {
    Route::get('', [LevelController::class, 'GetLevelInfo']);
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'priority'
], function ($router) {
    Route::get('', [PriorityController::class, 'GetPriorityInfo']);
});
