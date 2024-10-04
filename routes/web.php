<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ScoreController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/login', [AuthController::class, 'index'])->name('loginPage');
Route::post('/register', [AuthController::class, 'register'])->name('custom-register');
Route::post('/continue', [AuthController::class, 'continueWithoutRegister'])->name('continue');
Route::post('/logout', [AuthController::class, 'logout'])->name('logoutPage');

Route::middleware('player')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/quiz', [QuizController::class, 'quizForm'])->name('quiz');
    
    Route::get('/reponse', [ScoreController::class, 'showReponse'])->name("reponse");

    Route::get('/score', [ScoreController::class, 'index'])->name('score');
    Route::post('/score', [ScoreController::class, 'store']);
    Route::delete('/score', [ScoreController::class, 'destroy']);

    Route::get('/api/questions', [QuizController::class, 'getQuestions']);
    
});

Route::prefix('admin')->group(function() {
    
    Auth::routes();

    Route::middleware(['auth'])->group(function() {
        Route::resource('quizzes', QuizController::class);
        Route::resource('answers', AnswerController::class);
        Route::resource('players', PlayerController::class); 
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

});
