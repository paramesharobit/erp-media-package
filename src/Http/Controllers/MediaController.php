<?php

declare(strict_types=1);

namespace Arobit\ErpMedia\Http\Controllers;

use Arobit\ErpMedia\Contracts\MediaServiceContract;
use Arobit\ErpMedia\Http\Requests\StoreMediaRequest;
use Arobit\ErpMedia\Http\Resources\MediaResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

final class MediaController extends Controller
{
    public function store(StoreMediaRequest $request, MediaServiceContract $service): JsonResponse
    {
        $media = $service->store($request->toDto());

        return (new MediaResource($media))
            ->response()
            ->setStatusCode(201);
    }
}
