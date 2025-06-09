<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AssessmentResultController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Dashboard routes
Route::get('/guest_dashboard', [GuestController::class, 'dashboard'])->name('guest.dashboard');
Route::get('/user_dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

// Custom logout route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
})->name('logout');

// Guest routes
Route::prefix('guest')->name('guest.')->group(function () {
    Route::get('/guide', [GuestController::class, 'guide'])->name('guide');
    Route::get('/projects', [GuestController::class, 'projectsIndex'])->name('projects.index');
    Route::get('/projects/{project}', [GuestController::class, 'showProject'])->name('projects.show');
    Route::get('/projects/{project}/assess', [GuestController::class, 'assess'])->name('projects.assess');
    Route::post('/projects/{project}/assess', [GuestController::class, 'saveAssessment'])->name('projects.saveAssessment');
    Route::get('/projects/{project}/upload', [GuestController::class, 'upload'])->name('projects.upload');
    Route::post('/projects/{project}/upload', [GuestController::class, 'uploadFile'])->name('projects.uploadFile');
    Route::get('/submission-history', [GuestController::class, 'submissionHistoryIndex'])->name('submission_history.index');
    Route::get('/assessment-results', [GuestController::class, 'assessmentResultsIndex'])->name('assessment_results.index');
});

// Authenticated routes
Route::middleware(['auth'])->group(function () {

    // Project Routes
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/create', [ProjectController::class, 'create'])->name('create')->middleware('role:user');
        Route::post('/', [ProjectController::class, 'store'])->name('store');
        Route::get('/{project}', [ProjectController::class, 'show'])->name('show');
        Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::put('/{project}', [ProjectController::class, 'update'])->name('update');
        Route::get('/{project}/assess', [ProjectController::class, 'assess'])->name('assess');
        Route::post('/{project}/assess', [ProjectController::class, 'saveAssessment'])->name('saveAssessment');
    });

    // Assessment Results (via ProjectController)
    Route::prefix('assessment-results')->name('projects.assessment_results.')->group(function () {
        Route::get('/', [ProjectController::class, 'assessmentResultsIndex'])->name('index');
        Route::get('/{project}', [ProjectController::class, 'assessmentResultsShow'])->name('show');
    });

    // Guest Approval Routes
    Route::prefix('guest-approvals')->name('guest_approvals.')->group(function () {
        Route::get('/', [GuestController::class, 'guestApprovalsIndex'])->name('index');
        Route::post('/{document}/approve', [GuestController::class, 'approveGuestProposal'])->name('approve');
        Route::post('/{document}/reject', [GuestController::class, 'rejectGuestProposal'])->name('reject');
    });

    // User Profile Routes
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('user_profile.edit');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('user_profile.update');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});
