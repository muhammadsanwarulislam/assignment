<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Backend\Auth\AuthController;
use App\Http\Controllers\API\Backend\Page\PageController;
use App\Http\Controllers\API\Backend\Post\PostController;
use App\Http\Controllers\API\Backend\Follower\FollowerController;

// Backend API
/*
    Common API for Backend and Frontend
*/
Route::post('/auth/register', [AuthController::class,'register']);
Route::post('/auth/login', [AuthController::class,'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/follow/person', [FollowerController::class, 'store']);
    Route::get('/person/feed',[PostController::class, 'index']);
    Route::post('/page/create',[PageController::class, 'store']);
    Route::post('/page/{pageID}/attach-post',[PageController::class, 'storePageContent']);
    Route::post('/person/attach-post',[PostController::class, 'store']);
});
