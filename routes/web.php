<?php

use App\Http\Controllers\AJAX\ProductController as AJAXProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    dd("INDEX !");
})->name("index");

// Route::get('/', [ProductController::class, "index"]);

Route::group([
    "prefix" => "/ajax/products",
    "controller" => AJAXProductController::class,
    "as" => "ajax.products."
], function () {
    Route::post("/", "store")->name("store");
});


Route::prefix("todos")->name("todos.")->controller(TodoController::class)->group(function () {
    Route::get("/", "index")->name("index");
    Route::post("/", "store")->name("store");
    Route::put("/{id}", "update")->name("update");
    Route::delete("/{id}", "destroy")->name("destroy");
});
