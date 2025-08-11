<?php

use App\Livewire\Admin;
use App\Livewire\Aspirasi;
use App\Livewire\Mahasiswa;
use App\Livewire\MahasiswaAspirasi;
use App\Livewire\Rektor;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Warek;
use App\Livewire\WarekAspirasi;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware(['is_adminOrWarekOrRektor'])->group(function () {
    Route::middleware(['is_admin'])->group(function () {
        Route::get('dashboard/accounts/admin', Admin::class)->name('user.admin');
        Route::get('dashboard/accounts/rektor', Rektor::class)->name('user.rector');
        Route::get('dashboard/accounts/warek', Warek::class)->name('user.warek');
        Route::get('dashboard/accounts/mahasiswa', Mahasiswa::class)->name('user.mahasiswa');
    });
    Route::get('dashboard/aspirasi/lists', Aspirasi::class)->name('list.aspirasi')->middleware('is_adminOrRektor');
    Route::get('dashboard/warek/lists/aspirasi', WarekAspirasi::class)->name('warek.aspirasi')->middleware('is_warek');
});
Route::get('dashboard/mahasiswa/lists/aspirasi', MahasiswaAspirasi::class)->name('mahasiswa.aspirasi')->middleware('is_mahasiswa');

require __DIR__.'/auth.php';
