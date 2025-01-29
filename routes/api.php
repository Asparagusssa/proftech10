<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BannerImageController;
use App\Http\Controllers\BannerUrlController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmailEmailTypeController;
use App\Http\Controllers\EmailTypeController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PageSectionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductPropertyController;
use App\Http\Controllers\ProductRelateController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RelateController;
use App\Http\Controllers\SectionTypeController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TrustController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [SessionController::class, 'login']);
Route::apiResource('/products', ProductController::class)->only(['index', 'show']);
Route::apiResource('products.images', ProductImageController::class)->only(['index', 'show']);
Route::apiResource('/categories', CategoryController::class)->only(['index', 'show']);
Route::get('/categories/{category}/properties', [CategoryController::class, 'getProperties']);
Route::apiResource('/documents', DocumentController::class)->only(['index', 'show']);
Route::apiResource('/properties', PropertyController::class)->only(['index', 'show']);
Route::get('/products/{product}/properties', [ProductPropertyController::class, 'index']);
Route::apiResource('/relates', RelateController::class)->only(['index', 'show']);
Route::get('/products/{product}/relates', [ProductRelateController::class, 'index']);
Route::get('/pages/seos', [SeoController::class, 'getAll']);

Route::prefix('/pages')->group(function () {
    Route::get('/', [PageSectionController::class, 'getAllPages']);
    Route::apiResource('/{page}/sections', PageSectionController::class)->only(['index', 'show']);
    Route::apiResource('/sections/types', SectionTypeController::class)->only(['index', 'show']);
    Route::apiResource('/{page}/seos', SeoController::class)->only(['index', 'show']);
});

Route::apiResource('/banners', BannerController::class)->only(['index', 'show']);
Route::apiResource('/banners/{banner}/images', BannerImageController::class)->only(['index', 'show']);
Route::apiResource('/banners/{banner}/urls', BannerUrlController::class)->only(['index', 'show']);
Route::get('/contacts', [ContactController::class, 'index']);
Route::apiResource('/trusts', TrustController::class)->only(['index', 'show']);

Route::apiResource('/emails', EmailController::class)->only(['index', 'show']);
Route::get('/email/types', [EmailTypeController::class, 'index']);

Route::get('/documents/download/{path}', [DocumentController::class, 'download'])->where('path', '.*');

Route::post('/support', FeedbackController::class);
Route::post('/call', CallController::class);

Route::group(['middleware' => "auth:sanctum"], function () {
    Route::post('/logout', [SessionController::class, 'logout']);
    Route::apiResource('/products', ProductController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('products.images', ProductImageController::class)->only(['store', 'update', 'destroy']);
    Route::post('/products/{product}/properties/{property}', [ProductPropertyController::class, 'attach']);
    Route::delete('/products/{product}/properties/{property}', [ProductPropertyController::class, 'detach']);
    Route::get('/products/{product}/available-properties', [ProductController::class, 'availableProperties']);
    Route::post('/products/{product}/relates/{relate}', [ProductRelateController::class, 'attach']);
    Route::delete('/products/{product}/relates/{relate}', [ProductRelateController::class, 'detach']);
    Route::get('/products/{product}/available-relates', [ProductController::class, 'availableRelates']);
    Route::apiResource('/categories', CategoryController::class)->only(['store', 'update', 'destroy']);
    Route::delete('/categories/{category}/image', [CategoryController::class, 'deleteImage']);
    Route::apiResource('/documents', DocumentController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('/properties', PropertyController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('/relates', RelateController::class)->only(['store', 'update', 'destroy']);
    Route::prefix('/pages')->group(function () {
        Route::apiResource('/{page}/sections', PageSectionController::class)->only(['store', 'update', 'destroy']);
        Route::delete('/sections/{section}/image', [PageSectionController::class, 'deleteImage']);
        Route::apiResource('/sections/types', SectionTypeController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('/{page}/seos', SeoController::class)->only(['store', 'update', 'destroy']);
    });
    Route::apiResource('/banners', BannerController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('/banners/{banner}/images', BannerImageController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('/banners/{banner}/urls', BannerUrlController::class)->only(['store', 'update', 'destroy']);

    Route::match(['put', 'patch'], '/contacts', [ContactController::class, 'update']);

    Route::apiResource('/trusts', TrustController::class)->only(['store', 'update', 'destroy']);

    Route::prefix('/emails')->group(function () {
        Route::apiResource('/', EmailController::class)->only(['store', 'update', 'destroy']);
        Route::post('/{email}/types/{emailType}', [EmailEmailTypeController::class, 'attach']);
        Route::delete('/{email}/types/{emailType}', [EmailEmailTypeController::class, 'detach']);
    });
    Route::apiResource('/email/types', EmailTypeController::class)->only(['store', 'update', 'destroy']);
    Route::get('email/types/{emailType}/available-emails', [EmailEmailTypeController::class, 'availableEmails']);

});
