<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeacherGradeController;
use App\Http\Controllers\DepartmentHeadController;
use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuditLogController;

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
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | TEACHER
    |--------------------------------------------------------------------------
    */
    Route::prefix('teacher')->group(function () {
        Route::get('/grades', [TeacherGradeController::class, 'index'])
            ->name('teacher.grades');

        Route::get('/grades/create', [TeacherGradeController::class, 'create'])
            ->name('teacher.grades.create');

        Route::post('/grades', [TeacherGradeController::class, 'store'])
            ->name('teacher.grades.store');

        Route::post('/grades/{grade}/submit', [TeacherGradeController::class, 'submit'])
            ->name('teacher.grades.submit');
    });

    /*
    |--------------------------------------------------------------------------
    | DEPARTMENT HEAD
    |--------------------------------------------------------------------------
    */
    Route::prefix('department-head')->group(function () {
        Route::get('/approvals', [DepartmentHeadController::class, 'index'])
            ->name('dept.approvals');

        Route::post('/approvals/{grade}/approve', [DepartmentHeadController::class, 'approve'])
            ->name('dept.approve');

        Route::post('/approvals/{grade}/revision', [DepartmentHeadController::class, 'requestRevision'])
            ->name('dept.revision');
    });

    /*
    |--------------------------------------------------------------------------
    | REGISTRAR
    |--------------------------------------------------------------------------
    */
    Route::prefix('registrar')->group(function () {
        Route::get('/grades', [RegistrarController::class, 'index'])
            ->name('registrar.index');

        Route::post('/grades/{grade}/lock', [RegistrarController::class, 'lock'])
            ->name('registrar.lock');

        Route::get('/export', [RegistrarController::class, 'export'])
            ->name('registrar.export');
    });

    /*
    |--------------------------------------------------------------------------
    | REPORTS & GPA
    |--------------------------------------------------------------------------
    */
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports');

    /*
    |--------------------------------------------------------------------------
    | AUDIT LOGS
    |--------------------------------------------------------------------------
    */
    Route::get('/audit-logs', [AuditLogController::class, 'index'])
        ->name('audit.logs');
});

require __DIR__.'/auth.php';
