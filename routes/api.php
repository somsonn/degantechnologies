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
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
 
 
    Route::post('/login', [AuthController::class, 'login']); 
    Route::post('/resetpassword',[AuthController::class,'resetlink']);
    Route::post('/changepassword',[AuthController::class,'changepassword']);
    
    Route::middleware('auth:api')->group(function () {
    Route::get('/authenticated/user', [UserController::class, 'getAuthenticatedUser']);
    Route::resource('blogs', BlogController::class);
    Route::resource('team-members', TeamMemberController::class);
    
    Route::resource('contents', ContentController::class);
    Route::get('/contents/type/{type}', [ContentController::class, 'show']);
    Route::resource('company-histories', CompanyHistoryController::class);
    Route::resource('portfolios', PortfolioController::class);
    Route::resource('clients', ClientController::class);

    Route::post('/question/store', [QuestionController::class, 'store']);
    Route::get('/getall/question', [QuestionController::class, 'index']);
    Route::get('/count/question', [QuestionController::class, 'totalquestions']);
    Route::post('/subscriber/store',[SubscriptionController::class,'store']);

});