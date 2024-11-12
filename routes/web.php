<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\DailyTaskController;
use App\Http\Middleware\CheckNewDay;

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

// Áp dụng middleware cho nhóm route daily_tasks
Route::middleware([CheckNewDay::class])->group(function () {
    Route::get('/daily_tasks', [DailyTaskController::class, 'index'])->name('daily_tasks.index');
    Route::get('/daily_tasks/create', [DailyTaskController::class, 'create'])->name('daily_tasks.create');
    Route::post('/daily_tasks', [DailyTaskController::class, 'store'])->name('daily_tasks.store');
    Route::get('/daily_tasks/{daily_task}/edit', [DailyTaskController::class, 'edit'])->name('daily_tasks.edit');
    Route::put('/daily_tasks/{daily_task}', [DailyTaskController::class, 'update'])->name('daily_tasks.update');
    Route::delete('/daily_tasks/{daily_task}', [DailyTaskController::class, 'destroy'])->name('daily_tasks.destroy');
    Route::post('/daily_tasks/{id}/update_status', [DailyTaskController::class, 'updateStatus'])->name('daily_tasks.update_status');
});


