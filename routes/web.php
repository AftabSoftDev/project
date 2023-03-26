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

Route::get('/', function () {
    return view('index');
});

Route::view('/login','login')->name('log');
Route::post('/loginAuth', [FormController::class, 'login']);

Route::view('/home','index');
Route::view('/company','company');
Route::view('/assignuser','assignuser');
Route::view('/edit','edit');
Route::view('/table','table');

Route::get('/getData', [UserData::class, 'getData']);
Route::get('/AssignUser/{id}', [UserData::class, 'AssignUser']);
Route::post('/AssigUser', [UserData::class, 'AssigUser']);
Route::post('/comGetUpdate', [UserData::class, 'comGetUpdate']);
Route::post('/ComUpdateSave', [UserData::class, 'ComUpdateSave']);
Route::get('/comDelete/{id}', [UserData::class, 'comDelete']);


Route::get('/getUserData', [UserData::class, 'getUserData'])->name('getuserdata');
Route::post('/userGetUpdate', [UserData::class, 'userGetUpdate']);
Route::post('/UpdateSave', [UserData::class, 'UpdateSave']);
Route::get('/userDelete/{id}', [UserData::class, 'deleteUserData']);

Route::post('/AddData', [UserData::class, 'storeUser']);
Route::post('/storeCompany', [UserData::class, 'storeCompany']);
Route::get('/delete/{id}', [FormController::class, 'delete']);
Route::get('/editcont/{id}', [FormController::class, 'edit']);




Route::get('/logout', [FormController::class, 'logout']);
