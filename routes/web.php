<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::post("/product",[ProductController::class,"store"])->name("product.store");
Route::get("/",[ProductController::class,"index"]);
