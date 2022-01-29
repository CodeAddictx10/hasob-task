<?php

use App\Http\Controllers\AssetAssignmentController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
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

// Non- Auth routes
Route::post("register", [UserController::class, 'store']);
Route::post("login", [UserController::class, 'login']);

// Auth routes
Route::group(["middleware"=>"auth:sanctum"], function(){

    Route::resource("user", UserController::class);
    Route::resource("vendor", VendorController::class);
    Route::resource("asset", AssetController::class);
    Route::resource("assignment", AssetAssignmentController::class);
});

