<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Livewire\EditNote;
use App\Livewire\FullList;
use App\Livewire\NotePaper;
use App\Livewire\Overview;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// ---------------------------------------------------------------
Route::post('/avaibality/email', [AuthController::class, 'emailAvaibalityCheck'])->name('avaibality.email');
Route::post('/avaibality/username', [AuthController::class, 'usernameAvaibalityCheck'])->name('avaibality.username');
// ---------------------------------------------------------------
Route::middleware('guest')->controller(AuthController::class)->group(function(){
    Route::get('/login','viewLogin')->name('login');
    Route::post('/storeLogin','storeLogin')->name('storeLogin');
    Route::get('/register','viewRegister')->name('register');
    Route::post('/storeRegister','storeRegister')->name('storeRegister');
});
// ---------------------------------------------------------------
Route::middleware('auth')->group(function(){
    Route::get('/', FullList::class)->name('dashboard');
    Route::get('/note', NotePaper::class);
    Route::get('/create-group', NotePaper::class)->name('create_group');
    Route::get('/note/{slug}', EditNote::class);
    Route::get('/overview', Overview::class)->name('overview');
    Route::get('/note/delete/{slug}', [NoteController::class, 'deleteNote'])->name('delete_note');
    Route::get('/group/delete/{gid}', [NoteController::class, 'deleteGroup']);
});

/*
forge of empire
*/