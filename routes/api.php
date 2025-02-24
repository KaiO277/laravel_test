<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\StudentController;

// Auth Routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Book Routes
Route::apiResource('/books', BookController::class);
Route::post('books/{book}/ratings', [RatingController::class, 'store']);

Route::get('/students-list', [StudentController::class, 'index']);


Route::get('/courses-list', [CourseController::class, 'index']);
Route::post('/courses-add', [CourseController::class, 'store']);
