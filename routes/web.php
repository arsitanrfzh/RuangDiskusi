<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rute Publik (Bisa diakses siapa saja, termasuk tamu)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Halaman "Forum" (Daftar semua pertanyaan)
Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');

// Halaman "Detail Pertanyaan"
Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');


/*
|--------------------------------------------------------------------------
| Rute Privat (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Kategori (Hanya user login)
    Route::resource('categories', CategoryController::class);

    // CRUD Pertanyaan (Hanya user login)
    Route::resource('questions', QuestionController::class)->except(['index', 'show']);

    // CRUD Jawaban (Hanya user login)
    Route::post('/questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');
    Route::get('/answers/{answer}/edit', [AnswerController::class, 'edit'])->name('answers.edit');
    Route::patch('/answers/{answer}', [AnswerController::class, 'update'])->name('answers.update');
    Route::delete('/answers/{answer}', [AnswerController::class, 'destroy'])->name('answers.destroy');
});


// File route untuk login, register, dll. (Biarkan di paling bawah)
require __DIR__ . '/auth.php';
