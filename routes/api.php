<?php
use App\Http\Controllers\Api\BuildingController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\TenantController;
use App\Http\Controllers\Api\LeaseController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\MaintenanceController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PublicController;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');

// Public routes (no auth)
Route::get('/public/units', [PublicController::class, 'units']);
Route::get('/public/units/{unit}', [PublicController::class, 'unit']);
Route::get('/public/buildings', [PublicController::class, 'buildings']);
Route::post('/public/visit-request', [PublicController::class, 'visitRequest']);
Route::post('/public/waitlist', [PublicController::class, 'waitlist']);
Route::get('/public/testimonials', [PublicController::class, 'testimonials']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Buildings
    Route::apiResource('buildings', BuildingController::class);

    // Units
    Route::apiResource('units', UnitController::class);

    // Tenants
    Route::apiResource('tenants', TenantController::class);

    // Leases
    Route::apiResource('leases', LeaseController::class);

    // Invoices
    Route::apiResource('invoices', InvoiceController::class);

    // Payments
    Route::apiResource('payments', PaymentController::class);

    // Maintenance
    Route::apiResource('maintenance', MaintenanceController::class);

    // Expenses
    Route::apiResource('expenses', ExpenseController::class);
});
