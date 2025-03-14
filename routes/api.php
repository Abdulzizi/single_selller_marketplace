<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
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

    Route::post('/auth/login', [AuthController::class, 'login']); //->middleware(['throttle:5,30']); //->middleware(['signature']);
    Route::post('/auth/logout', [AuthController::class, 'logout']); //->middleware(['signature']);
    Route::get('/auth/profile', [AuthController::class, 'profile'])->middleware(['auth.api']);

    // Users
    Route::get('/users', [UserController::class, 'index']); //->middleware(['auth.api', 'refresh.token', 'role:user.view']);
    Route::get('/users/{id}', [UserController::class, 'show']); //->middleware(['auth.api', 'role:user.view']);
    Route::post('/users', [UserController::class, 'store']); //->middleware(['auth.api', 'role:user.create|roles.view']);
    Route::put('/users', [UserController::class, 'update']); //->middleware(['auth.api', 'role:user.update||roles.view']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']); //->middleware(['auth.api', 'role:user.delete']);

    // Roles
    Route::get('/roles', [RoleController::class, 'index']); //->middleware(['auth.api', 'role:roles.view']);
    Route::get('/roles/{id}', [RoleController::class, 'show']); //->middleware(['auth.api', 'role:roles.view']);
    Route::post('/roles', [RoleController::class, 'store']); //->middleware(['auth.api', 'role:roles.create']);
    Route::put('/roles', [RoleController::class, 'update']); //->middleware(['auth.api', 'role:roles.update']);
    Route::delete('/roles/{id}', [RoleController::class, 'destroy']); //->middleware(['auth.api', 'role:roles.delete']);

    // Categories
    Route::get('/categories', [CategoryController::class, 'index']); //->middleware(['auth.api', 'role:categories.view']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']); //->middleware(['auth.api', 'role:categories.view']);
    Route::post('/categories', [CategoryController::class, 'store']); //->middleware(['auth.api', 'role:categories.create']);
    Route::put('/categories', [CategoryController::class, 'update']); //->middleware(['auth.api', 'role:categories.update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']); //->middleware(['auth.api', 'role:categories.delete']);

    // Products endpoint
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/product/{slug}', [ProductController::class, 'showBySlug']);

    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    // Carts endpoint
    Route::get('/carts', [CartController::class, 'index']);
    Route::get('/carts/{id}', [CartController::class, 'show']);
    Route::post('/carts', [CartController::class, 'store']);
    Route::put('/carts', [CartController::class, 'update']);
    Route::delete('/carts/{id}', [CartController::class, 'destroy']);

    // Orders endpoint
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::put('/orders', [OrderController::class, 'update']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

    // Send email
    Route::get('/send-email', [MailController::class, 'sendEmail']);

    // Forgot password
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);
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
