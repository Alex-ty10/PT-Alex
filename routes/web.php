<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    /* Route::view('/dashboard', 'dashboard')->name('dashboard'); */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/info-city', [CityController::class, 'index'])
        ->name('city.infoCity');

    Route::post('/info-city', [CityController::class, 'store'])
    ->name('city.infoCity.store');


    Route::get('/my-cities', [CityController::class, 'getMyCities'])
    ->name('city.myCities');

    Route::get('/my-cities/{city}', [CityController::class, 'show'])
    ->name('city.city.show');

    Route::delete('/my-cities/{city}', [CityController::class, 'destroy'])
    ->name('city.city.destroy');

});

require __DIR__.'/auth.php';
