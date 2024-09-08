<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\TokenVerificationMiddleware;

Route::view('/', 'pages.home');


// API Routes
Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::post('/send-otp', [UserController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UserController::class, 'VerifyOTPCode']);
Route::post('/reset-password', [UserController::class, 'ResetPassword'])->middleware(TokenVerificationMiddleware::class);
Route::get('/logout', [UserController::class, 'userLogout']);
Route::get('/user-profile', [UserController::class, 'UserProfile'])->middleware(TokenVerificationMiddleware::class);
Route::post('/update-profile', [UserController::class, 'UpdateProfile'])->middleware(TokenVerificationMiddleware::class);


// Category API
Route::get('/category-list', [CategoryController::class, 'CategoryList'])->middleware(TokenVerificationMiddleware::class);
Route::post('/category-create', [CategoryController::class, 'CategoryCreate'])->middleware(TokenVerificationMiddleware::class);
Route::post('/category-update', [CategoryController::class, 'CategoryUpdate'])->middleware(TokenVerificationMiddleware::class);
Route::post('/category-delete', [CategoryController::class, 'CategoryDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post('/category-by-id', [CategoryController::class, 'CategoryById'])->middleware(TokenVerificationMiddleware::class);


// Customer API
Route::get('/customer-list', [CustomerController::class, 'CustomerList'])->middleware(TokenVerificationMiddleware::class);
Route::post('/customer-create', [CustomerController::class, 'CustomerCreate'])->middleware(TokenVerificationMiddleware::class);
Route::post('/customer-update', [CustomerController::class, 'CustomerUpdate'])->middleware(TokenVerificationMiddleware::class);
Route::post('/customer-delete', [CustomerController::class, 'CustomerDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post('/customer-by-id', [CustomerController::class, 'CustomerById'])->middleware(TokenVerificationMiddleware::class);


// Product API
Route::get('/product-list', [ProductController::class, 'ProductList'])->middleware(TokenVerificationMiddleware::class);
Route::post('/product-create', [ProductController::class, 'ProductCreate'])->middleware(TokenVerificationMiddleware::class);
Route::post('/product-update', [ProductController::class, 'ProductUpdate'])->middleware(TokenVerificationMiddleware::class);
Route::post('/product-delete', [ProductController::class, 'ProductDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post('/product-by-id', [ProductController::class, 'ProductById'])->middleware(TokenVerificationMiddleware::class);



// Invoice API
Route::post('/invoice-create', [InvoiceController::class, 'InvocieCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get('/invoice-select', [InvoiceController::class, 'InvoiceSelect'])->middleware(TokenVerificationMiddleware::class);
Route::post('/invoice-details', [InvoiceController::class, 'InvoiceDetails'])->middleware(TokenVerificationMiddleware::class);
Route::post('/invoice-delete', [InvoiceController::class, 'InvoiceDelete'])->middleware(TokenVerificationMiddleware::class);



// Dashboard API
Route::post('/summary', [DashboardController::class, 'Summary'])->middleware(TokenVerificationMiddleware::class);



// Page Routes
Route::get('/dashboard', [UserController::class, 'DashboardPage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/userRegistration', [UserController::class, 'UserRegistrationPage']);
Route::get('/userLogin',  [UserController::class, 'UserLoginPage']);
Route::get('/resetPassword', [UserController::class, 'ResetPasswordPage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/verifyOtp', [UserController::class, 'VerifyOTPPage']);
Route::get('/sendOtp', [UserController::class, 'SendOTPPage']);
Route::get('/userProfile', [UserController::class, 'UserProfilePage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/categoryPage', [CategoryController::class, 'CategoryPage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/customerPage', [CustomerController::class, 'CustomerPage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/productPage', [ProductController::class, 'ProductPage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/salePage', [InvoiceController::class, 'SalePage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/invoicePage', [InvoiceController::class, 'InvoicePage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/reportPage', [ReportController::class, 'ReportPage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/sales-report/{FromDate}/{ToDate}', [ReportController::class, 'SalseReport'])->middleware(TokenVerificationMiddleware::class);
