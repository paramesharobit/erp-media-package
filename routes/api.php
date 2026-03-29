<?php

declare(strict_types=1);

use Erp\MediaPackage\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(static function (): void {
    Route::post('/media', [MediaController::class, 'store']);
    Route::delete('/media/{media}', [MediaController::class, 'destroy']);
});
