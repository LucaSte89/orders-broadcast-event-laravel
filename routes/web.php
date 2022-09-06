<?php

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
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::get('/register', function () {
    return view('auth.register');
});
Route::post('/register', [\App\Http\Controllers\UserController::class, 'register'])->name('register');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $ordini = App\Models\Ordini::orderBy('id', 'desc')->get();

        return view('admin.dashboard', compact('ordini'));
    })->name('dashboard');

    Route::post('/dashboard/add-order', [\App\Http\Controllers\DashboardController::class, 'addOrder'])->name('add-order');
});
