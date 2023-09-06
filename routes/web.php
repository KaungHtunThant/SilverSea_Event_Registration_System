<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\WinnerController;
use App\Http\Controllers\VisitorController;
use App\Http\Middleware\EnsurekeyExist;
use App\Http\Middleware\ReturntoDashboard;
use App\Http\Middleware\VisitorNotFound;
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
// Private routes
Route::middleware(EnsurekeyExist::class)->group(function () {
    Route::get('/attendance/export', [AttendanceController::class, 'export']);
    Route::get('/', [AttendanceController::class, 'index']);

    Route::get('/users', [AuthController::class, 'index']);

    Route::post('/users', [AuthController::class, 'register']);

    Route::get('/logout', [AuthController::class, 'logout']);

    Route::patch('/users/{id}', [AuthController::class, 'update']);

    Route::get('/users/{id}', [AuthController::class, 'pwreset']);

    //visitors
    Route::get('/visitors/export', [VisitorController::class, 'export']);
    Route::resource('/visitors', VisitorController::class);

    //winners
    Route::get('/winners', [WinnerController::class, 'index']);

    //lottery
    Route::get('/lottery', [WinnerController::class, 'rng']);


});

Route::get('/id/{id}', [VisitorController::class, 'id'])
    ->middleware(VisitorNotFound::class);

// Public routes

Route::get('/login', function () {
    return view('login.index');
})->middleware(ReturntoDashboard::class);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/winners', [WinnerController::class, 'rng']);

Route::get('/barcode', function () {
    return view('test.index');
});

// Route::get('/form', function () {
//     return view('form.index');
// });

// Route::post('/form', [VisitorController::class, 'form_add']);

Route::get('/welcome', function () {
    return view('public.visitor_notfound');
});

// Route::get('/', function () {
//     return redirect('/welcome');
// });