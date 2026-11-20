<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route("login");
});

Route::get('/register', [UserController::class, 'registerForm'])->name("register");
Route::post('/register', [UserController::class, 'register']);

Route::get('/login', [UserController::class, 'loginForm'])->name("login");
Route::post('/login', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout'])->name("logout");

Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard");

// Course routes (admin)
Route::get('/course/create', [CourseController::class, 'course_add'])->name("course.create")->middleware("auth");
Route::post('/course/store', [CourseController::class, 'course_addform'])->name("course.store")->middleware("auth");
Route::delete('/course/{course}', [CourseController::class, 'course_delete'])->name("course.delete")->middleware("auth");
Route::get('/course/{course}/edit', [CourseController::class, 'course_edit'])->name("course.edit")->middleware("auth");
Route::post('/course/{course}', [CourseController::class, 'course_editform'])->name("course.update")->middleware("auth");

// Application routes
Route::get('/application/create/{course_id?}', [ApplicationController::class, 'application_add'])->name("application.create")->middleware("auth");
Route::post('/application/store', [ApplicationController::class, 'application_addform'])->name("application.store")->middleware("auth");
Route::get('/application/my', [ApplicationController::class, 'application_list'])->name("application.my")->middleware("auth");
Route::get('/application/admin', [ApplicationController::class, 'application_admin'])->name("application.admin")->middleware("auth");
Route::post('/application/{application}/status', [ApplicationController::class, 'application_update_status'])->name("application.update_status")->middleware("auth");
Route::post('/application/{application}/review', [ApplicationController::class, 'application_review'])->name("application.review")->middleware("auth");
