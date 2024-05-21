<?php

use App\Http\Controllers\ContatoController;
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



Route::get('contato', [ContatoController::class, 'index'])->name('contato.index');
Route::get('contato/create', [ContatoController::class, 'create'])->name('contato.create');
Route::post('contato/store', [ContatoController::class, 'store'])->name('contato.store');
Route::get('contato/update', [ContatoController::class, 'update'])->name('contato.update');
Route::get('contato/show/{id}', [ContatoController::class, 'show'])->name('contato.show');
Route::get('contato/edit/{id}', [ContatoController::class, 'show'])->name('contato.edit');
Route::get('contato/update/{id}', [ContatoController::class, 'update'])->name('contato.update');
