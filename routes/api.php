<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('user', App\Http\Controllers\UserController::class);

Route::apiResource('role', App\Http\Controllers\RoleController::class);

Route::apiResource('sms-queue', App\Http\Controllers\SmsQueueController::class);

Route::apiResource('location', App\Http\Controllers\LocationController::class);

Route::apiResource('company', App\Http\Controllers\CompanyController::class);

Route::apiResource('story', App\Http\Controllers\StoryController::class);

Route::apiResource('seo', App\Http\Controllers\SeoController::class);

Route::apiResource('section', App\Http\Controllers\SectionController::class);

Route::apiResource('service', App\Http\Controllers\ServiceController::class);

Route::apiResource('ingredient-category', App\Http\Controllers\IngredientCategoryController::class);

Route::apiResource('ingredient', App\Http\Controllers\IngredientController::class);

Route::apiResource('product-category', App\Http\Controllers\ProductCategoryController::class);

Route::apiResource('product-option', App\Http\Controllers\ProductOptionController::class);

Route::apiResource('product', App\Http\Controllers\ProductController::class);

Route::apiResource('review', App\Http\Controllers\ReviewController::class);

Route::apiResource('order', App\Http\Controllers\OrderController::class);

Route::apiResource('payment-history', App\Http\Controllers\PaymentHistoryController::class);

Route::apiResource('money-transfer', App\Http\Controllers\MoneyTransferController::class);

