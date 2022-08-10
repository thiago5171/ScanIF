<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StatusItemsController;
use App\Http\Controllers\ItemMongoController;
use App\Http\Controllers\ItemController;
/*

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


Route::get("/status",[StatusItemsController::class,'getAll']);
Route::post("/status/new",[StatusItemsController::class,'create']);
Route::get("/status/{id}",[StatusItemsController::class,'getById']);
Route::delete("/status/{id}/delete",[StatusItemsController::class,'destroy']);
Route::put("/status/{id}/edit",[StatusItemsController::class,'update']);

Route::post("/item/new",[ItemController::class,'create']);
Route::post("/item/validator",[ItemController::class,'analyzeItemWithRegister']);
Route::get("/item",[ItemController::class,'getAll']);
Route::get("/item/{id}",[ItemController::class,'getById']);
Route::get("/item/{id}/status",[ItemController::class,'getByStatusId']);

Route::get("/item/report/{tombamento}/tombamento",[ItemMongoController::class,'getItemByIdentifier']);
Route::post("/item/report/new",[ItemMongoController::class,'store']);
Route::get("/item/find/all",[ItemMongoController::class,'getList']);
Route::post("/item/report/indexing",[ItemMongoController::class,'indexingReport']);

Route::delete("/item/report/clear",[ItemMongoController::class,'clearDatabase']);
