<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get("/", "index");
    Route::post("/", "create_city");
    Route::put("/{city_id}/update", "update_city");
    Route::delete("/{city_id}/delete", "destroy_city");
});
Route::controller(CityController::class)->group(function () {
    Route::get('/city/{city_id}/users', 'index');
    Route::post('/city/{city_id}/users', 'create_user');
    Route::put('/users/{user_id}/update', 'update_user');
    Route::delete('/users/{city_id}/{user_id}/delete', 'destroy_user');
});
