<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WinnerController;
use App\Http\Controllers\VisitorController;
use App\Http\Middleware\EnsurekeyExist;
use App\Http\Middleware\ReturntoDashboard;
use App\Http\Controllers\TestPreparer;

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
//Private routes
Route::middleware(EnsurekeyExist::class)->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    });

    Route::get('/users', function () {
        return view('users.index');
    });
    Route::post('/users', [AuthController::class, 'register']);

    Route::get('/logout', [AuthController::class, 'logout']);

    //visitors
    Route::resource('/visitors', VisitorController::class);

    //winners
    Route::get('/winners', function () {
        return view('admin.winners.index'); 
    });

    //lottery
    Route::get('/lottery', function () {
        // return view('admin.lottery.index'); 
        return view('admin.index');
    });
    
    Route::post('/winners', [WinnerController::class, 'rng']);
});

//Public routes

Route::get('/login', function () {
    return view('login.index');
})->middleware(ReturntoDashboard::class);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/barcode', function () {
    return view('test.index');
});