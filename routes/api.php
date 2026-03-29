<?php

declare(strict_types=1);

use Arobit\ErpMedia\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

Route::prefix((string) config('erp-media.route_prefix'))
    ->middleware(config('erp-media.middleware', ['api']))
    ->group(function (): void {
        Route::post('/media', [MediaController::class, 'store'])
            ->name('erp-media.store');
    });
