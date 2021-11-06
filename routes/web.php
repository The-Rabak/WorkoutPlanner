<?php

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
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get("/workouts", "WorkoutController@index")->name("workouts");
    Route::post("/workouts", "WorkoutController@store");
    Route::get("/workouts/new", "WorkoutController@create")->name("newWorkout");
    Route::get("/workouts/edit/{workout}", "WorkoutController@edit")->name("editWorkout");
    Route::post("/workouts/edit/{workout}", "WorkoutController@update")->name("editWorkout");

    Route::get("/categories", "CategoryController@index")->name("categories");
    Route::get("/categories/new", "CategoryController@create")->name("newCategory");
    Route::get("/categories/{category}", "CategoryController@show");
    Route::get("/categories/edit/{category}", "CategoryController@edit")->name("editCategory");
    Route::patch("/categories/{category}", "CategoryController@update");

    Route::post("/categories", "CategoryController@store");
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
