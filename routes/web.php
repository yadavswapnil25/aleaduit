<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuditController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\BookletController;
use App\Http\Controllers\Admin\ExamEnrollmentController;
use App\Http\Controllers\Admin\BookletQuestionController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/changePassword', [UserController::class, 'changePassword'])->name('user.changePassword');
    Route::put('/changePasswordUpdate', [ProfileController::class, 'changePasswordUpdate'])->name('user.changePasswordUpdate');
    Route::get('/resetPassword/{id}', [UserController::class, 'resetPassword']);
    Route::put('/resetPassword/{id}', [UserController::class, 'sendResetUpdate'])->name('reset.password.update');
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/client/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('/client/store', [ClientController::class, 'store'])->name('client.store');
    Route::get('/client/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
    Route::get('/client/show/{id}', [ClientController::class, 'show'])->name('client.show');
    Route::post('/client/update', [ClientController::class, 'update'])->name('client.update');
    Route::get('/client/addYear/{id}', [ClientController::class, 'showAddYearForm'])->name('client.addYearForm');
    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('client.destroy');
    Route::post('/client/addYear', [ClientController::class, 'addYear'])->name('client.addYear');
    Route::get('/client/download/{id}', [ClientController::class, 'download'])->name('client.download');
    Route::get('/client/{id}/master', [ClientController::class, 'master'])->name('client.master');
    Route::get('/client/{id}/master1', [ClientController::class, 'master1'])->name('client.master1');
    Route::get('/client/{id}/master2', [ClientController::class, 'master2'])->name('client.master2');
    Route::get('/client/{id}/master-data', [ClientController::class, 'getMasterData'])->name('client.getMasterData');
    Route::delete('/client/master-data/{id}', [ClientController::class, 'deleteMasterData'])->name('client.deleteMasterData');
    Route::post('/client/{id}/save-master-data', [ClientController::class, 'saveMasterData'])->name('client.saveMasterData');
    Route::get('/client/sheet1', [ClientController::class, 'sheet1'])->name('client.sheet1');
    Route::get('/client/{client_id}/sheet/{id}', [ClientController::class, 'sheet1']);
    Route::post('/client/{id}/save-inputs', [ClientController::class, 'saveInputs'])->name('client.saveInputs');
    Route::resource('users', UserController::class);
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('/user/restore/{id}', [UserController::class, 'restore'])->name('user.restore');
    Route::get('/user/status/{id}', [UserController::class, 'status'])->name('user.status');
    Route::get('/user/export', [UserController::class, 'export'])->name('user.export');
    Route::resource('booklets', BookletController::class);
    Route::get('/booklet/edit/{id}', [BookletController::class, 'edit'])->name('booklet.edit');
    Route::post('/booklet/update', [BookletController::class, 'update'])->name('booklet.update');
    Route::get('/booklet/delete/{id}', [BookletController::class, 'destroy'])->name('booklet.delete');
    Route::resource('bookletQuestion', BookletQuestionController::class);
    Route::get('/booklet/question/delete/{id}', [BookletQuestionController::class, 'destroy'])->name('booklet.question.delete');
    
    // Define resource routes for exam enrollments and custom routes for edit, update, and delete actions.
    Route::resource('examEnrollments', ExamEnrollmentController::class);
    // Route::get('/examEnrollment/edit/{id}', [ExamEnrollmentController::class, 'edit'])->name('examEnrollments.edit');
    // Route::post('/examEnrollment/update', [ExamEnrollmentController::class, 'update'])->name('examEnrollments.update');
    Route::get('/examEnrollment/delete/{id}', [ExamEnrollmentController::class, 'destroy'])->name('examEnrollments.delete');
    // Route for fetching soft-deleted exam enrollments
    // Route to restore a soft-deleted exam enrollment
    Route::get('/examEnrollment/restore/{id}', [ExamEnrollmentController::class, 'restoreExamEnrollment'])->name('examEnrollment.restore');

    Route::resource('audits', AuditController::class);
    Route::get('/audit/edit/{id}', [AuditController::class, 'edit'])->name('audit.edit');
    Route::post('/audit/update', [AuditController::class, 'update'])->name('audit.update');

});

require __DIR__.'/auth.php';
