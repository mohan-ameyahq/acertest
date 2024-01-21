<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcerController;

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
    return redirect('/reports');
});

Route::get('/reports', [AcerController::class,'Reports']);
Route::post('/getReports', [AcerController::class,'getReports'])->name('getReports');
Route::post('/report/{studentid}/{reportid}', [AcerController::class,'Report'])->name('Report');
Route::get('/tests', [AcerController::class,'Tests']);
Route::get('/getTests', [AcerController::class,'getTests'])->name('getTests');




