<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');

    // Sender Api
    Route::post('sender/parcel/edit', 'App\Http\Controllers\AuthController@postEditSenderParcel');

    // Biker Api
    Route::post('biker/parcel/edit', 'App\Http\Controllers\AuthController@postEditBikerParcel');

});
