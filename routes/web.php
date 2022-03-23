<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/login', [App\Http\Controllers\Web\UserController::class, 'getLogin'])->name('get-sender-login');

// Sender Routes

    Route::get('sender/parcels/{id}', [App\Http\Controllers\Web\UserController::class, 'getSenderParcels'])->name('get-sender-parcels');
    Route::get('sender/parcel/edit/{id}', [App\Http\Controllers\Web\UserController::class, 'getEditSenderParcel'])->name('edit-sender-parcel');


// Biker Routes

    Route::get('biker/parcels/{id}', [App\Http\Controllers\Web\UserController::class, 'getBikerParcels'])->name('get-biker-parcels');
    Route::get('biker/parcel/edit/{id}', [App\Http\Controllers\Web\UserController::class, 'getEditBikerParcel'])->name('edit-biker-parcel');


