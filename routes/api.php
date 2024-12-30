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

Route::post('/login', [AuthController::class, 'login']);

//dd(Route::middleware('auth:api'));
Route::middleware('auth:api')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::resource('blogs', BlogController::class);
    Route::resource('team-members', TeamMemberController::class);
    Route::resource('contents', ContentController::class);
    Route::get('/contents/{type}', [ContentController::class, 'show']);
    Route::resource('company-histories', CompanyHistoryController::class);
    Route::resource('portfolios', PortfolioController::class);
    Route::resource('clients', ClientController::class);
});
