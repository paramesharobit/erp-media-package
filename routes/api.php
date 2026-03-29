<?php

declare(strict_types=1);

use ErpMediaPackage\Http\Controllers\Api\MediaController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(static function (): void {
    Route::post('media', [MediaController::class, 'store']);
    Route::get('media', [MediaController::class, 'index']);
    Route::delete('media/{id}', [MediaController::class, 'destroy']);
});
