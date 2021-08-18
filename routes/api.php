<?php

use App\Models\TasksList;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Constraint\SameSize;




Route::post('auth', 'App\Http\Controllers\Api\v1\AuthController@authenticate');
Route::post('auth-refresh', 'App\Http\Controllers\Api\v1\AuthController@refreshToken');
Route::get('user', 'App\Http\Controllers\Api\v1\AuthController@getAuthenticatedUser');



Route::group([
    'prefix' => 'v1',
    'namespace' => 'App\Http\Controllers\Api\v1',
  'middleware'=>'auth:api' 
  
  ], function () {
  
    Route::get('status/{id}/tasks', 'StatusController@tasks');
    Route::apiResource('status', 'StatusController');
    Route::apiResource('tasks', 'TasksListController');
    Route::apiResource('users', 'UserController');
  });