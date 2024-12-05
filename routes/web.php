<?php

use App\Http\Controllers\TesztController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teszt', [TesztController::class, 'teszt']);
Route::get('/names', [TesztController::class, 'names']);
Route::get('/names/create/{family}/{name}', [TesztController::class, 'namesCreate']);
Route::get('/families/create/{name}', [TesztController::class, 'familyCreate']);

Route::post('/names/delete', [TesztController::class, 'deleteName']);

Route::get('/names/manage/surname', [TesztController::class, 'manageSurname']);
Route::post('/names/manage/surname/delete', [TesztController::class, 'deleteSurname']);
Route::post('/names/manage/surname/new', [TesztController::class, 'newSurname']);

Route::post('/names/manage/name/new', [TesztController::class,'newName']);