<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ScholarshipController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ReviewerController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\ScholarshipController as StudentScholarshipController;
use App\Http\Controllers\Student\ApplicationController as StudentApplicationController;
use App\Http\Controllers\Student\ResultController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Reviewer\ReviewerDashboardController;
use App\Http\Controllers\Reviewer\AssignedApplicationController;
use App\Http\Controllers\Reviewer\EvaluationController;
use App\Http\Controllers\Reviewer\ReviewerProfileController;

// ========== PUBLIC ROUTES ==========
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'submitContact'])->name('contact.submit');
Route::get('/choose-role', [PublicController::class, 'chooseAcc'])->name('choose.acc');
Route::get('/choose-student', [PublicController::class, 'studentSignup'])->name('choose.student');
Route::get('/choose-reviewer', [PublicController::class, 'reviewerSignup'])->name('choose.reviewer');

// ========== DASHBOARD ROUTE - Role-based redirect ==========
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'student') {
        return redirect()->route('student.dashboard');
    } elseif ($user->role === 'reviewer') {
        return redirect()->route('reviewer.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ========== ADMIN ROUTES ==========
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/scholarships', [ScholarshipController::class, 'index'])->name('scholarships.index');
    Route::get('/scholarships/create', [ScholarshipController::class, 'create'])->name('scholarships.create');
    Route::post('/scholarships', [ScholarshipController::class, 'store'])->name('scholarships.store');
    Route::get('/scholarships/{id}/edit', [ScholarshipController::class, 'edit'])->name('scholarships.edit');
    Route::put('/scholarships/{id}', [ScholarshipController::class, 'update'])->name('scholarships.update');
    Route::delete('/scholarships/{id}', [ScholarshipController::class, 'destroy'])->name('scholarships.destroy');
    
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

    Route::get('/applications', [App\Http\Controllers\Admin\ApplicationAssignmentController::class, 'index'])->name('applications.index');
Route::get('/applications/{id}/assign', [App\Http\Controllers\Admin\ApplicationAssignmentController::class, 'assign'])->name('applications.assign');
Route::post('/applications/{id}/assign-reviewer', [App\Http\Controllers\Admin\ApplicationAssignmentController::class, 'assignReviewer'])->name('applications.assign-reviewer');
Route::get('/applications/{id}', [App\Http\Controllers\Admin\ApplicationAssignmentController::class, 'show'])->name('applications.show');
    
    Route::get('/reviewers', [ReviewerController::class, 'index'])->name('reviewers.index');
    Route::get('/reviewers/approve', [ReviewerController::class, 'approve'])->name('reviewers.approve');
    Route::post('/reviewers/{id}/approve', [ReviewerController::class, 'approveStore'])->name('reviewers.approve-store');
    Route::post('/reviewers/{id}/reject', [ReviewerController::class, 'reject'])->name('reviewers.reject');
    Route::get('/reviewers/{id}/edit', [ReviewerController::class, 'edit'])->name('reviewers.edit');
    Route::put('/reviewers/{id}', [ReviewerController::class, 'update'])->name('reviewers.update');
    Route::delete('/reviewers/{id}', [ReviewerController::class, 'destroy'])->name('reviewers.destroy');
    
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
});

// ========== STUDENT ROUTES ==========
Route::prefix('student')->name('student.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/scholarships', [StudentScholarshipController::class, 'browse'])->name('scholarships.browse');
    Route::get('/scholarships/{id}', [StudentScholarshipController::class, 'details'])->name('scholarships.details');
    Route::get('/applications', [StudentApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/create/{scholarshipId}', [StudentApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications/store/{scholarshipId}', [StudentApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{id}', [StudentApplicationController::class, 'show'])->name('applications.show');
    Route::get('/results', [ResultController::class, 'index'])->name('results.index');
    Route::get('/profile', [StudentProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [StudentProfileController::class, 'update'])->name('profile.update');
});

// ========== REVIEWER ROUTES ==========
Route::prefix('reviewer')->name('reviewer.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [ReviewerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/assigned', [AssignedApplicationController::class, 'index'])->name('assigned.index');
    Route::get('/assigned/{id}', [AssignedApplicationController::class, 'show'])->name('assigned.show');
    Route::get('/evaluate/{id}', [EvaluationController::class, 'evaluate'])->name('evaluation.evaluate');
    Route::post('/evaluate/{id}', [EvaluationController::class, 'storeScores'])->name('evaluation.store');
    Route::get('/evaluate/{id}/finalize', [EvaluationController::class, 'finalize'])->name('evaluation.finalize');
    Route::get('/evaluate/{id}/confirm', [EvaluationController::class, 'confirmSubmit'])->name('evaluation.confirm');
    Route::get('/profile', [ReviewerProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ReviewerProfileController::class, 'update'])->name('profile.update');
});

// ========== AUTH ROUTES ==========
require __DIR__.'/auth.php';