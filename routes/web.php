<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;

// Show the create form
Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');

// Store a new question
Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');

Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');

// Show the edit form
Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');

// Update a question
Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');

Route::get('/questions/index', [QuestionController::class, 'index'])->name('questions.index');

