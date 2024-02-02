<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\TransactionsController;

//use Illuminate\Support\Facades\Session;

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
    if (!auth()->check())
        return view('welcome');
    else
        return redirect('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('language/{lang}', function ($lang) {
    Log::info("rout  was called");

    Session::put('locale', $lang);
    Log::info("language = " . $lang);
    Log::info("locale = " . Session::get("locale", "null"));
    return back();
});


// Protect these routes so only admin users can access them
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
});


// Public access
Route::get('/warehouses', [WarehouseController::class, 'index'])->middleware(['auth'])->name('warehouses.index');

// Protected routes for head of the department
Route::middleware(['auth', 'headOfDepartment'])->group(function () {
    Route::get('/warehouses/create', [WarehouseController::class, 'create'])->name('warehouses.create');
    Route::post('/warehouses', [WarehouseController::class, 'store'])->name('warehouses.store');
    Route::get('/warehouses/{warehouse}/edit', [WarehouseController::class, 'edit'])->name('warehouses.edit');
    Route::put('/warehouses/{warehouse}', [WarehouseController::class, 'update'])->name('warehouses.update');
    Route::delete('/warehouses/{warehouse}', [WarehouseController::class, 'destroy'])->name('warehouses.destroy');
});



// Protected routes for head of the department
Route::middleware(['auth', 'headOfDepartment'])->group(function () {
    Route::get('/items/create', [ItemsController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemsController::class, 'store'])->name('items.store');
    Route::get('/items/{item}/edit', [ItemsController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}', [ItemsController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [ItemsController::class, 'destroy'])->name('items.destroy');
});

// Public access
Route::get('/items', [ItemsController::class, 'index'])->middleware(['auth'])->name('items.index');
Route::get('/items/{item}', [ItemsController::class, 'show'])->middleware(['auth'])->name('items.show');



Route::middleware(['auth'])->group(function () {
    Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionsController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionsController::class, 'store'])->name('transactions.store');
    Route::put('/transactions/update-status', [TransactionsController::class, 'updateStatus'])->name('transactions.updateStatus');
    Route::delete('/transactions/{transaction}', [TransactionsController::class, 'destroy'])->name('transactions.destroy');

});
require __DIR__ . '/auth.php';
