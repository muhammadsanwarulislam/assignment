<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Backend\Auth\AuthController;
use App\Http\Controllers\API\Backend\UserFollower\UserFollowerController;
use App\Http\Controllers\API\Backend\UserPage\UserPageController;

// Backend API
/*
    Common API for Backend and Frontend
*/
Route::post('/auth/register', [AuthController::class,'register']);
Route::post('/auth/login', [AuthController::class,'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/follow/persons', [UserFollowerController::class, 'listOfFollower']);
    Route::post('/follow/person/{personId?}', [UserFollowerController::class, 'sentFollowRequest']);
    Route::post('/page/create',[UserPageController::class, 'store']);
});
