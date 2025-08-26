<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/', [ItemController::class, 'index'])->name('welcome');
Route::get('/admin', [ItemController::class, 'admin'])->name('admin');

Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/search', [ItemController::class, 'search'])->name('items.search');
Route::post('/items/upload-photo', [ItemController::class, 'uploadPhoto'])->name('items.upload-photo');
Route::post('/items/add-comment', [ItemController::class, 'addComment'])->name('items.add-comment');