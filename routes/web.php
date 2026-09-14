<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts/{contact}/image', [ContactController::class, 'image'])->name('contacts.image');
Route::resource('contacts', ContactController::class);
