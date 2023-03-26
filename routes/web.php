<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserData;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Default Route
Route::get('/', [UserData::class, 'getUserData'])->name('getuserdata');


// Comapany Details Route
Route::post('/AddData', [UserData::class, 'storeUser']);
Route::post('/storeCompany', [UserData::class, 'storeCompany']);
Route::get('/getData', [UserData::class, 'getData']);
Route::post('/comGetUpdate', [UserData::class, 'comGetUpdate']);
Route::post('/ComUpdateSave', [UserData::class, 'ComUpdateSave']);
Route::get('/comDelete/{id}', [UserData::class, 'comDelete']);
Route::view('/company','company');


// User Details Route
Route::post('/userGetUpdate', [UserData::class, 'userGetUpdate']);
Route::post('/UpdateSave', [UserData::class, 'UpdateSave']);
Route::get('/userDelete/{id}', [UserData::class, 'deleteUserData']);
Route::view('/home','index');



// Assign Users Route
Route::get('/AssignUser/{id}', [UserData::class, 'AssignUser']);
Route::post('/AssigUser', [UserData::class, 'AssigUser']);
Route::view('/assignuser','assignuser');






