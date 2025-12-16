<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslationController;


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('translations', TranslationController::class);
    Route::get('translations/search', [TranslationController::class, 'search']);
    Route::get('translations/export', [TranslationController::class, 'export']);
});
