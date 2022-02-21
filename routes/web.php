<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
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
    return view('auth.login');
})->name('cover');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('file-import-export', [UserController::class, 'fileImportExport']);
Route::post('file-import', [UserController::class, 'fileImport'])->name('file-import');
Route::get('file-export/{batch}/{process}', [UserController::class, 'fileExport'])->name('file-export');


Route::get('wallet-list-import', [UserController::class, 'fileImportBatch'])->name('wallet-list-import');
Route::post('wallet-list', [UserController::class, 'wallet_list'])->name('wallet-list');


// process one is marking transfer between own accounts

Route::get('process-one/{batch}', [UserController::class, 'process_one'])->name('process-one');

//process two is marking 'from address' as unique, format -> batch_loopNumber 
Route::get('process-two/{batch}', [UserController::class, 'process_two'])->name('process-two');


// for testing purposes
Route::get('view-list', [UserController::class, 'view_list'])->name('view-list');

// Route::get('layout', [UserController::class, 'layout']);
Route::get('layout', function () {
    return view('layout');
});


Route::get('logout', [UserController::class, 'Logout'])->name('logout');


Route::get('view-individual/{batch}', [UserController::class, 'view_individual'])->name('view-individual');

Route::get('export-individual/{batch}', [UserController::class, 'export_individual'])->name('export-individual');