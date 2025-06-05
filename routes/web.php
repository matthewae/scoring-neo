<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/guest_dashboard', [App\Http\Controllers\GuestController::class, 'dashboard'])->name('guest.dashboard');
Route::get('/user_dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('user.dashboard');

Route::prefix('guest')->name('guest.')->group(function () {
    Route::get('/guide', [App\Http\Controllers\GuestController::class, 'guide'])->name('guide');
    Route::get('/projects', [App\Http\Controllers\GuestController::class, 'projectsIndex'])->name('projects.index');
    Route::get('/projects/{project}', [App\Http\Controllers\GuestController::class, 'showProject'])->name('projects.show');
    Route::get('/projects/{project}/assess', [App\Http\Controllers\GuestController::class, 'assess'])->name('projects.assess');
    Route::post('/projects/{project}/assess', [App\Http\Controllers\GuestController::class, 'saveAssessment'])->name('projects.saveAssessment');
    Route::get('/projects/{project}/upload', [App\Http\Controllers\GuestController::class, 'upload'])->name('projects.upload');
    Route::post('/projects/{project}/upload', [App\Http\Controllers\GuestController::class, 'uploadFile'])->name('projects.uploadFile');
});

Route::middleware(['auth'])->group(function () {
    // User Dashboard
    // Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('user.dashboard');

    // Project Routes
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [App\Http\Controllers\ProjectController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\ProjectController::class, 'store'])->name('store');
        Route::get('/{project}', [App\Http\Controllers\ProjectController::class, 'show'])->name('show');
        Route::get('/{project}/edit', [App\Http\Controllers\ProjectController::class, 'edit'])->name('edit');
        Route::put('/{project}', [App\Http\Controllers\ProjectController::class, 'update'])->name('update');
        Route::get('/{project}/assess', [App\Http\Controllers\ProjectController::class, 'assess'])->name('assess');
        Route::post('/{project}/assess', [App\Http\Controllers\ProjectController::class, 'saveAssessment'])->name('saveAssessment');
    });

    // Guest Approvals Routes
    Route::prefix('guest-approvals')->name('guest_approvals.')->group(function () {
        Route::get('/', [App\Http\Controllers\GuestController::class, 'guestApprovalsIndex'])->name('index');
        Route::post('/{document}/approve', [App\Http\Controllers\GuestController::class, 'approveGuestProposal'])->name('approve');
        Route::post('/{document}/reject', [App\Http\Controllers\GuestController::class, 'rejectGuestProposal'])->name('reject');
    });

    // User Profile Routes
    Route::get('/profile/edit', [App\Http\Controllers\UserProfileController::class, 'edit'])->name('user_profile.edit');
    Route::put('/profile', [App\Http\Controllers\UserProfileController::class, 'update'])->name('user_profile.update');

    // Reports Routes
    Route::get('/reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
});
