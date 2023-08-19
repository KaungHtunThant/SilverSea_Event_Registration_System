<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestPreparer;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\VisitorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->users();
});

Route::post('/initA', [TestPreparer::class, 'createAdmin']);
Route::post('/initV', [TestPreparer::class, 'createVisitors']);
Route::post('/initAtt', [TestPreparer::class, 'createAttendances']);

// Route::get('/test', [TestPreparer::class, 'test']);

Route::post('/scan/{id}', [AttendanceController::class, 'store']);

// Route::get('/test/visitor', [VisitorController::class, 'view_visitors']);

// Route::get('/test/att', [VisitorController::class, 'view_visitors']);