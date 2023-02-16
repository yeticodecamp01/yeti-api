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
    Route::post("logout",[AuthorsController::class,"logout"]);


    Route::post("create-book",[BookController::class,"store"]);
    Route::get("list-books", [BookController::class, "listBook"]);
    Route::post("author-books",[BookController::class,"authorBook"]);
    Route::post("single-book/{id}",[BookController::class,"singleBook"]); //book detail
    Route::post("update-book/{id}", [BookController::class, "updateBook"]);
    Route::get("delete-book/{id}", [BookController::class, "deleteBook"]);

});



