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
        // todo: make this a POST request with a form request in the view
        Route::get('/locations/{location}/travel', [Controllers\LocationController::class, 'travel'])->name('locations.travel');

        Route::get('buildings', [Controllers\BuildingController::class, 'index'])->name('buildings');
        Route::post('buildings/construct', [Controllers\BuildingController::class, 'construct'])->name('buildings.construct');
        Route::post('buildings/upgrade', [Controllers\BuildingController::class, 'upgrade'])->name('buildings.upgrade');
        Route::post('buildings/work', [Controllers\BuildingController::class, 'work'])->name('buildings.work');

    });

    Route::get('travelling', [Controllers\CharacterController::class, 'travelling'])->name('character.travelling');
});

Route::get('/', [Controllers\IndexController::class, 'index'])->name('index');
