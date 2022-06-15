<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Backend\Auth\AuthController;
use App\Http\Controllers\API\Backend\Follower\FollowerController;
use App\Http\Controllers\API\Backend\Page\PageController;

// Backend API
/*
    Common API for Backend and Frontend
*/
Route::post('/auth/register', [AuthController::class,'register']);
Route::post('/auth/login', [AuthController::class,'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/follow/person/{personId?}', [FollowerController::class, 'sentFollowRequest']);
    Route::post('/page/create',[PageController::class, 'store']);
});
