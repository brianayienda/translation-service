<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslationController;

Route::middleware('auth:sanctum')->group(function () {
    // Only the routes you actually use
    Route::get('translations', [TranslationController::class, 'index']);
    Route::post('translations', [TranslationController::class, 'store']);
    Route::get('translations/search', [TranslationController::class, 'search']);
    Route::get('translations/export', [TranslationController::class, 'export']);
    Route::put('translations/{translation}', [TranslationController::class, 'update']);
    Route::delete('translations/{translation}', [TranslationController::class, 'destroy']);
});
