<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pegawai',[EmployeeController::class,'index'])->name('pegawai');

Route::get('/tambahpegawai',[EmployeeController::class,'tambahpegawai'])->name('tambahpegawai');

Route::post('/insertdata',[EmployeeController::class,'insertdata'])->name('insertdata');

Route::get('/show/{id}',[EmployeeController::class,'show'])->name('show');

Route::post('/edit/{id}',[EmployeeController::class,'edit'])->name('edit');

Route::get('/delete/{id}',[EmployeeController::class,'delete'])->name('delete');

//export pdf
Route::get('/exportpdf',[EmployeeController::class,'exportpdf'])->name('exportpdf');
//export excel
Route::get('/exportexcel',[EmployeeController::class,'exportexcel'])->name('exportexcel');



