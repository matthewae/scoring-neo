<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AssessmentResultController;

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
    Route::get('/assessment-results/{projectDocument}', [GuestController::class, 'assessmentResultsShow'])->name('assessment_results.show');
});

// Routes untuk user dengan role dan login
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    Route::prefix('user/assessment-results')->name('user.assessment_results.')->group(function () {
        Route::get('/', [UserController::class, 'assessmentResultsIndex'])->name('index');
        Route::get('/{project}', [UserController::class, 'assessmentResultsShow'])->name('show');
    });

    Route::prefix('user/documents')->name('user.documents.')->group(function () {
        Route::get('/upload', [UserController::class, 'uploadDocumentForm'])->name('upload');
        Route::post('/store', [UserController::class, 'storeDocument'])->name('store');
    });

    Route::prefix('user/assessment-submissions')->name('user.assessment_submissions.')->group(function () {
        Route::get('/', [UserController::class, 'assessmentSubmissionsIndex'])->name('index');
        Route::post('/{projectDocument}/approve', [UserController::class, 'approveSubmission'])->name('approve');
        Route::post('/{projectDocument}/reject', [UserController::class, 'rejectSubmission'])->name('reject');
    });

    Route::get('/user/documents', [UserController::class, 'documentsIndex'])->name('user.documents.index');
    Route::get('/user/projects/sync-documents', [ProjectController::class, 'syncProjectDocuments'])->name('user.projects.syncDocuments');
    Route::get('/user/projects/{project}/documents', [UserController::class, 'getProjectDocuments'])->name('user.projects.getDocuments');

    // ✅ Project Routes dipindahkan ke prefix 'user/projects'
    Route::prefix('user/projects')->name('user.projects.')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/create', [ProjectController::class, 'create'])->name('create')->middleware('role:user');
        Route::post('/', [ProjectController::class, 'store'])->name('store');
        Route::get('/{project}', [ProjectController::class, 'show'])->name('show');
        Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::put('/{project}', [ProjectController::class, 'update'])->name('update');
        Route::get('/{project}/assess', [ProjectController::class, 'assess'])->name('assess');
        Route::put('/{project}/assess', [ProjectController::class, 'saveAssessment'])->name('saveAssessment');
    });
});

// Routes yang hanya butuh login (authenticated), bukan khusus role user
Route::middleware(['auth', 'user'])->group(function () {
    // ... existing code ...

    // Guest Approval Routes
    Route::prefix('guest-approvals')->name('guest_approvals.')->group(function () {
        Route::get('/', [UserController::class, 'guestApprovalsIndex'])->name('index');
        Route::post('/{document}/approve', [UserController::class, 'approveGuestProposal'])->name('approve');
        Route::post('/{document}/reject', [UserController::class, 'rejectGuestProposal'])->name('reject');
    });

    // User Profile Routes
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('user_profile.edit');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('user_profile.update');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});
