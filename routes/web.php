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

Auth::routes(['verify' => true]);

Route::middleware([
    'auth',
    'verified',
    'character.status.attempt-free',
])->group(function () {

    Route::middleware('character.status.check')->group(function() {

        Route::get('dashboard', [Controllers\DashboardController::class, 'index'])->name('dashboard');

        Route::get('locations', [Controllers\LocationController::class, 'index'])->name('locations');
        Route::post('locations/{location}/travel', [Controllers\LocationController::class, 'travel'])->name('locations.travel');

        Route::get('training', [Controllers\TrainingController::class, 'index'])->name('training');
        Route::post('training', [Controllers\TrainingController::class, 'perform'])->name('training.perform');

        Route::get('buildings', [Controllers\BuildingController::class, 'index'])->name('buildings');
        Route::post('buildings/construct', [Controllers\BuildingController::class, 'construct'])->name('buildings.construct');
        Route::post('buildings/upgrade', [Controllers\BuildingController::class, 'upgrade'])->name('buildings.upgrade');
        Route::post('buildings/work', [Controllers\BuildingController::class, 'work'])->name('buildings.work');

        Route::get('items', [Controllers\ItemController::class, 'index'])->name('items');
        // todo: make POST requests vvv
        Route::get('items/equip/{item}', [Controllers\ItemController::class, 'equip'])->name('items.equip');
        Route::get('items/unequip/{item}', [Controllers\ItemController::class, 'unequip'])->name('items.unequip');
        Route::get('items/craft/{item}', [Controllers\ItemController::class, 'craft'])->name('items.craft');

        Route::post('attack/{defending_character}', [Controllers\CharacterController::class, 'attack'])->name('character.attack');

    });

    // todo: rename to status/$status?
    Route::get('currently/travelling', [Controllers\StatusController::class, 'travelling'])->name('character.travelling');
    Route::get('currently/training', [Controllers\StatusController::class, 'training'])->name('character.training');
});

Route::get('/', [Controllers\IndexController::class, 'index'])->name('index');
