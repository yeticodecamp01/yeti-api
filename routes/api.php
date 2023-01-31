<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BookController;

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

Route::post("register",[AuthorsController::class,"register"]);
Route::post("login",[AuthorsController::class,"login"]);

Route::group(["middleware" => ["auth:api"]], function(){

    Route::get("profile",[AuthorsController::class,"profile"]);
    Route::post("profile",[AuthorsController::class,"logout"]);


    Route::post("create-book",[BookController::class,"create"]);
    Route::post("author-books",[BookController::class,"authorBook"]);
    Route::post("single-book",[BookController::class,"show"]);
    Route::post("update/{id}",[BookController::class,"update"]);
    Route::post("delete/{id}",[BookController::class,"destroy"]);



});



