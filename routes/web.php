<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesertaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('container.home');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::name('register')->prefix('registrasi')->group(function () {
        Route::get('/', [AuthController::class, 'view_regist']);
        Route::post('/', [AuthController::class, 'action_regist']);
    });
    Route::get('/registrasi-telah-ditutup', function () {
        return view('container.closereg');
    })->name('closereg');
    Route::name('login')->prefix('login')->group(function () {
        Route::get('/', [AuthController::class, 'view_login']);
        Route::post('/', [AuthController::class, 'action_login']);
    });
    Route::name('forgot-password')->prefix('forgot-password')->group(function () {
        Route::get('/', [AuthController::class, 'view_forgot_password']);
        Route::post('/', [AuthController::class, 'action_forgot_password']);
    });
});

Route::middleware('auth')->group(function () {
    Route::name('dashboard')->get('dashboard', function () {
        return view('container.dashboard-client');
    });
    Route::get('logout', function () {
        Auth::logout();
        return redirect()->route('home');
    })->name('logout');
    Route::name('peserta')->prefix('peserta')->group(function () {
        Route::get('/', [PesertaController::class, 'd_view']);
        Route::post('/', [PesertaController::class, 'd_action']);
        Route::delete('/', [PesertaController::class, 'd_action']);
    });
    Route::name('absensi')->prefix('absensi')->group(function () {
        Route::get('/', [AbsenController::class, 'viewAbsen']);
        Route::post('/', [AbsenController::class, 'doAbsen']);
    });

    Route::get('sertif', [PesertaController::class, 'sertif'])->name('sertif');

    Route::name('akun.setting')->prefix('setting')->group(function () {
        // view account settings
        Route::get('/', [AuthController::class, 'view_acc_setting']); // show view settings

        // response account settings
        Route::post('/', [AuthController::class, 'action_acc_setting']); // give response by submission
    });

});

Route::name('a.')->prefix('mahavira')->group(function () {
    Route::name('login')->prefix('login')->group(function () {
        Route::get('/', [AuthController::class, 'mahavira_view_login']);
        Route::post('/', [AuthController::class, 'mahavira_action_login']);
    });
    Route::middleware('admin')->group(function () {
        Route::get('/', function () {
            return redirect()->route('a.peserta');
        });
        Route::get('logout', [AuthController::class, 'mahavira_action_logout'])->name('logout');
        Route::prefix('absensi')->name('absensi')->group(function () {
            Route::get('/', [AbsenController::class, 'admin']);
            Route::get('excel', [AbsenController::class, 'excel'])->name('.excel');
        });
        Route::get('peserta', [AdminController::class, 'a_view'])->name('peserta');
        Route::post('peserta', [AdminController::class, 'submit'])->name('peserta');
        Route::delete('peserta', [AdminController::class, 'submit'])->name('peserta');
    });
});
