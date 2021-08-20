<?php

use App\Http\Controllers;
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

Auth::routes();

Route::middleware([
    'auth',
    'character.status.attempt-free',
])->group(function () {

    Route::middleware('character.status.check')->group(function() {

        Route::get('dashboard', [Controllers\DashboardController::class, 'index'])->name('dashboard');

        Route::get('locations', [Controllers\LocationController::class, 'index'])->name('locations');
        Route::get('locations/{location}/travel', [Controllers\LocationController::class, 'travel'])->name('locations.travel');

        Route::get('training', [Controllers\TrainingController::class, 'index'])->name('training');
        Route::post('training', [Controllers\TrainingController::class, 'perform'])->name('training.perform');

    });

    // todo: rename to status/$status?
    Route::get('currently/travelling', [Controllers\CharacterController::class, 'travelling'])->name('character.travelling');
    Route::get('currently/training', [Controllers\CharacterController::class, 'training'])->name('character.training');
});

Route::get('/', [Controllers\IndexController::class, 'index'])->name('index');
