<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DependencyInjection\RegisterControllerArgumentLocatorsPass;
Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => ['auth']], function () {
    Route::get('/index', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create')->middleware(['permission:create user']);
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit')->middleware(['permission:edit user']);
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::get('/show/{user}', [UserController::class, 'show'])->name('show');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy')->middleware(['permission:delete user']);
});


Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
})->name('dashboard');




Route::middleware(['auth'])->group(function () {
    Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('/profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
    Route::post('/profiles', [ProfileController::class, 'store'])->name('profiles.store');
    Route::get('/profiles/{profile}', [ProfileController::class, 'show'])->name('profiles.show');
    Route::get('/profiles/{profile}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profiles/{profile}', [ProfileController::class, 'update'])->name('profiles.update');
    Route::put('/teacherAUpdateProfile/{profile}', [ProfileController::class, 'updateStatus'])->name('profiles.updateStatus');
    Route::put('/teacherBUpdateProfile/{profile}', [ProfileController::class, 'updateStatusB'])->name('profiles.updateStatusB');
    Route::delete('/profiles/{profile}', [ProfileController::class, 'destroy'])->name('profiles.destroy');
    Route::post('/profiles/{profile}/submit-to-teacher-a', [ProfileController::class, 'submitToTeacherA'])->name('profiles.submitToTeacherA');
    Route::post('/profiles/{profile}/submit-to-teacher-b', [ProfileController::class, 'submitToTeacherB'])->name('profiles.submitToTeacherB');
    Route::post('/profiles/{profile}/confirm-by-teacher-b', [ProfileController::class, 'confirmByTeacherB'])->name('profiles.confirmByTeacherB');
    Route::get('/teacher-a/profiles', [ProfileController::class, 'teacherAIndex'])->name('profiles.teacherAIndex');
    Route::get('/teacher-a/profiles/{profile}', [ProfileController::class, 'teacherAReview'])->name('profiles.teacherAReview');
    Route::get('/teacher-b/profiles', [ProfileController::class, 'teacherBIndex'])->name('profiles.teacherBIndex');
    Route::get('/teacher-b/profiles/{profile}', [ProfileController::class, 'teacherBReview'])->name('profiles.teacherBReview');
    Route::post('/profiles/{profile}/approveByA', [ProfileController::class, 'approveByA'])->name('profiles.approveByA');
    Route::post('/profiles/{profile}/rejectByA', [ProfileController::class, 'rejectByA'])->name('profiles.rejectByA');
    Route::post('/profiles/{profile}/approveByB', [ProfileController::class, 'approveByB'])->name('profiles.approveByB');
    Route::post('/profiles/{profile}/rejectByB', [ProfileController::class, 'rejectByB'])->name('profiles.rejectByB');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

