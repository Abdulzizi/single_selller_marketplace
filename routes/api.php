<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SiteController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api;" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->middleware(['log.activity'])->group(function () {
    Route::get('/', [SiteController::class, 'index']);

    // Authentication routes
    Route::post('/auth/login', [AuthController::class, 'login'])->middleware('throttle:10,2');
    Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware(['auth.api']);
    Route::get('/auth/profile', [AuthController::class, 'profile'])->middleware(['auth.api']);
    Route::post('/auth/refresh', [AuthController::class, 'refresh']);

    // Public routes
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/product/{slug}', [ProductController::class, 'showBySlug']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);

    // Testing route
    Route::get('/dashboard/data', [DashboardController::class, 'index']);

    // Forgot password (public)
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);

    // Register new users
    Route::post('/users', [UserController::class, 'store']);

    // Protected routes (require auth)
    Route::middleware(['auth.api'])->group(function () {
        // Users
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/{id}', [UserController::class, 'show']);
        Route::put('/users', [UserController::class, 'update']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);

        // Roles
        Route::get('/roles', [RoleController::class, 'index']);
        Route::get('/roles/{id}', [RoleController::class, 'show']);
        Route::post('/roles', [RoleController::class, 'store']);
        Route::put('/roles', [RoleController::class, 'update']);
        Route::delete('/roles/{id}', [RoleController::class, 'destroy']);

        // Categories
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories', [CategoryController::class, 'update']);
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

        // Products (management)
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products', [ProductController::class, 'update']);
        Route::delete('/products/{id}', [ProductController::class, 'destroy']);

        // Carts (user-specific)
        Route::get('/carts', [CartController::class, 'index']);
        Route::get('/carts/{id}', [CartController::class, 'show']);
        Route::post('/carts', [CartController::class, 'store']);
        Route::put('/carts', [CartController::class, 'update']);
        Route::delete('/carts/{id}', [CartController::class, 'destroy']);

        // Orders (user-specific)
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/orders/{id}', [OrderController::class, 'show']);
        Route::post('/orders', [OrderController::class, 'store']);
        Route::put('/orders', [OrderController::class, 'update']);
        Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
    });

    // Send email
    Route::get('/send-email', [MailController::class, 'sendEmail']);
});

Route::get('/', function () {
    return response()->failed(['Endpoint yang anda minta tidak tersedia']);
});

/**
 * Jika Frontend meminta request endpoint API yang tidak terdaftar
 * maka akan menampilkan HTTP 404
 */
Route::fallback(function () {
    return response()->failed(['Endpoint yang anda minta tidak tersedia']);
});
