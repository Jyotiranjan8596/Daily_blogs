<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthcontroller;
use App\Http\Controllers\Post_Controler;
use App\Http\Controllers\Comments_Controller;
use App\Http\Controllers\Video_Controller;
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


//Routes for UserController
Route::middleware('auth:api')->group(function () {
    Route::get("userauth/{id?}", [UserAuthcontroller::class, 'getData']);
    Route::get("userauth/{name?}", [UserAuthcontroller::class, 'getName']);
    Route::get("user-post/{id?}", [UserAuthcontroller::class, 'show_post']);

    // Routes for post controllers
    Route::post("create-post", [Post_Controler::class, 'create_post']);
    Route::get("view-post/{id?}", [Post_Controler::class, 'fetch_Data']);
    Route::get("show-post", [Post_Controler::class, 'all_posts']);
    Route::post("update-post/{id?}", [Post_Controler::class, 'update_post']);
    Route::get("delete-post/{id?}", [Post_Controler::class, 'detele_post']);
    Route::get("show-comment/{id?}", [Post_Controler::class, 'show_comments']);

    // Routes for comments controllers
    Route::post("create-comment", [Comments_Controller::class, 'create_comments']);
    Route::get("view-comment/{id?}", [Comments_Controller::class, 'fetch_comment']);
    Route::post("update-comments/{id?}", [Comments_Controller::class, 'update_comments']);
    Route::get("delete-comments/{id?}", [Comments_Controller::class, 'delete_comment']);

    //Routs for video controller
    Route::post("add-video", [Video_Controller::class, 'create_videos']);
    Route::get("view-video/{id?}", [Video_Controller::class, 'fetch_video']);
    Route::post("update-video/{id?}", [Video_Controller::class, 'update_video']);
    Route::get("delete-video/{id?}", [Video_Controller::class, 'delete_video']);
});

Route::post("login", [UserAuthcontroller::class, 'login']);
Route::post("forgotpassword", [UserAuthcontroller::class, 'forgotPassword']);
Route::post("register", [UserAuthcontroller::class, 'register']);
