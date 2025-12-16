<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslationController;
use App\Models\User;

Route::get('/token', function () {
    $user = User::firstOrCreate(
        ['email' => 'test@example.com'],
        ['name' => 'Test User', 'password' => bcrypt('password')]
    );

    return $user->createToken('postman-token')->plainTextToken;
});

Route::middleware('auth:sanctum')->group(function () {
    // Only the routes you actually use
    Route::get('translations', [TranslationController::class, 'index']);
    Route::post('translations', [TranslationController::class, 'store']);
    Route::get('translations/search', [TranslationController::class, 'search']);
    Route::get('translations/export', [TranslationController::class, 'export']);
    Route::put('translations/{translation}', [TranslationController::class, 'update']);
    Route::delete('translations/{translation}', [TranslationController::class, 'destroy']);
});
