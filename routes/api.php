<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CompanyHistoryController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/resetpassword', [AuthController::class, 'resetlink']);
Route::post('/changepassword/{id}', [AuthController::class, 'changepassword']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user/getall', [UserController::class, 'index']);
    Route::get('/edit/user/{id}', [UserController::class, 'edit']);

});


// Resource Routes for different controllers
Route::middleware('auth:api')->group(function () {
    Route::resource('/blogs', BlogController::class);
    Route::resource('/team-members', TeamMemberController::class);
    Route::resource('/contents', ContentController::class);
    Route::resource('/company-histories', CompanyHistoryController::class);
    Route::resource('/portfolios', PortfolioController::class);
    Route::resource('/clients', ClientController::class);
});
