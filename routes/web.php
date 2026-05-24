<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
  |--------------------------------------------------------------------------
  | Frontend Controllers
  |--------------------------------------------------------------------------
 */
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SampleController;
use App\Http\Controllers\Frontend\InquiryController;

/*
  |--------------------------------------------------------------------------
  | Admin Controllers
  |--------------------------------------------------------------------------
 */
use App\Http\Controllers\Admin\SampleController as AdminSampleController;
use App\Http\Controllers\Admin\BuyerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SampleTypeController;
use App\Http\Controllers\Admin\ItemTypeController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\DashboardController;

/*
  |--------------------------------------------------------------------------
  | Public Frontend Routes (Accessible to Everyone)
  |--------------------------------------------------------------------------
 */

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::any('/contact', [HomeController::class, 'contact'])->name('contact');

// All Samples
Route::get('/samples', [SampleController::class, 'index'])->name('samples.index');
Route::get('/samples-details', [SampleController::class, 'details'])->name('samples.details');

// Single Sample Details
Route::get('/samples/{id}', [SampleController::class, 'show'])->name('samples.show');

// Inquiry Submit
Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');
Route::get('/ajax/samples', [SampleController::class, 'ajaxFilter'])->name('samples.ajax');

/*
  |--------------------------------------------------------------------------
  | Authorized Admin Routes (Logged-in and Verified Users Only)
  |--------------------------------------------------------------------------
 */
Route::middleware(['auth', 'verified'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {


            /* --- Dashboard --- */

            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            /* --- Profile Management --- */
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

            Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

            /* --- Sample Management --- */
            Route::get('samples/api', [AdminSampleController::class, 'apiSamples'])->name('api.samples');
            Route::resource('samples', AdminSampleController::class);
            Route::delete('samples/gallery-image/{id}', [SampleController::class, 'deleteGalleryImage'])->name('samples.delete_image');

            /* --- Buyer Management --- */
            Route::get('buyers/api', [BuyerController::class, 'apiData'])->name('buyers.api');
            Route::resource('buyers', BuyerController::class);

            /* --- Category Management --- */
            Route::get('categories/api', [CategoryController::class, 'apiData'])->name('categories.api');
            Route::resource('categories', CategoryController::class);

            /* --- Sample Type Management --- */
            Route::get('sample-types/api', [SampleTypeController::class, 'apiData'])->name('sample-types.api');
            Route::resource('sample-types', SampleTypeController::class);

            /* --- Item Type Management --- */
            Route::get('item-types/api', [ItemTypeController::class, 'apiData'])->name('item-types.api');
            Route::resource('item-types', ItemTypeController::class);

            /* --- Inquiry Management --- */
            Route::get('/inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
            Route::get('/inquiries/{id}', [AdminInquiryController::class, 'show'])->name('inquiries.show');
            Route::delete('/inquiries/{id}', [AdminInquiryController::class, 'destroy'])->name('inquiries.destroy');
        });

/*
  |--------------------------------------------------------------------------
  | Authentication Routes (Breeze generated hooks)
  |--------------------------------------------------------------------------
 */
require __DIR__ . '/auth.php';
