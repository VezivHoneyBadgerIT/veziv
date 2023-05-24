<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VezivAdminController;
use App\Http\Controllers\VezivhourController;
use App\Http\Controllers\VezivappointController;
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
    $VezivAdminController=new VezivAdminController;
    $appointments=$VezivAdminController->getAppointments();
    return view('welcome',['vezivadmin'=>App\Models\VezivAdmin::firstOrFail(),'appointments' => $appointments]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('vezivadmin', VezivAdminController::class)
    ->only(['index', 'update'])
    ->middleware(['auth', 'verified']);

Route::resource('vezivhours', VezivhourController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('vezivappoint', VezivappointController::class)
    ->only(['index', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('vezivcreateappoint', VezivappointController::class)
    ->only(['store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
