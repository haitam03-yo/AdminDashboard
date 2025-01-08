<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ForecastController;
use App\Http\Controllers\OrderController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix('')->group(function () {
    Route::get('/welcome', function () {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    })->name('welcome');
});

use App\Http\Controllers\DashboardController;
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('home');
    })->name("home");

    // Product Management
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index'); // View all products
        Route::get('/create', [ProductController::class, 'create'])->name('create'); // Add a product
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit'); // Edit a product
        Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('destroy'); // Delete product
    });

    // Forecasting
    Route::prefix('forecast')->name('forecast.')->group(function () {
        Route::get('/{id}', [ForecastController::class, 'getPrediction'])->name('product'); // Prediction form
        Route::post('/show/{id}', [ForecastController::class, 'show'])->name('show'); // Display prediction result
    });



    // Profile Management
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit'); // Edit profile
        Route::patch('/', [ProfileController::class, 'update'])->name('update'); // Update profile
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy'); // Delete profile
    });
});

Route::get('/product-count', [ProductController::class, 'getProductCount']);


require __DIR__.'/auth.php';
