<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiaryController;

Route::get('/', [DiaryController::class, 'index'])->name('diary.index');
Route::get('/create', [DiaryController::class, 'create'])->name('diary.create');
Route::post('/store', [DiaryController::class, 'store'])->name('diary.store');
Route::get('/edit/{id}', [DiaryController::class, 'edit'])->name('diary.edit');
Route::put('/update/{id}', [DiaryController::class, 'update'])->name('diary.update');
Route::delete('/destroy/{id}', [DiaryController::class, 'destroy'])->name('diary.destroy');
Route::get('/english-journey', [DiaryController::class, 'englishJourney'])->name('diary.english-journey');

Route::get('/future-work', [DiaryController::class, 'showFutureWork'])->name('future_work.index');
Route::get('/future-work/{id}/edit', [DiaryController::class, 'editFutureWork'])->name('future_work.edit');
Route::put('/future-work/{id}', [DiaryController::class, 'updateFutureWork'])->name('future_work.update');