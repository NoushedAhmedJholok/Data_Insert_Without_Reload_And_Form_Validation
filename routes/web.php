<?php

use App\Http\Controllers\InputController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/insert', [InputController::class, 'insert'])->name('insert');
