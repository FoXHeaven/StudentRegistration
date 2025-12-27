<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authenticated Common Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Role Dashboards
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:student'])
    ->get('/student/dashboard', fn () => view('student.dashboard'))
    ->name('student.dashboard');

Route::middleware(['auth', 'role:teacher'])
    ->get('/teacher/dashboard', fn () => view('teacher.dashboard'))
    ->name('teacher.dashboard');

/*
|--------------------------------------------------------------------------
| Unified Dashboard (for Breeze / Fortify)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    return Auth::user()->role === 'teacher'
        ? redirect()->route('teacher.dashboard')
        : redirect()->route('student.dashboard');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {
        Route::resource('courses', TeacherCourseController::class);
    });

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        // 查看已报名课程（必须放在 {course} 前面，否则会被匹配到）
        Route::get('courses/enrolled', [StudentCourseController::class, 'enrolled'])
            ->name('courses.enrolled');

        // 查看所有可报名课程
        Route::get('courses', [StudentCourseController::class, 'index'])
            ->name('courses.index');

        // 查看单个课程详情
        Route::get('courses/{course}', [StudentCourseController::class, 'show'])
            ->name('courses.show');

        // 报名课程
        Route::post('courses/{course}/enroll', [StudentCourseController::class, 'enroll'])
            ->name('courses.enroll');
    });

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
