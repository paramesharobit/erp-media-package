<?php

declare(strict_types=1);

namespace ErpMediaPackage\Http\Controllers\Api;

use ErpMediaPackage\Contracts\MediaServiceInterface;
use ErpMediaPackage\DTO\MediaData;
use ErpMediaPackage\Http\Requests\DestroyMediaRequest;
use ErpMediaPackage\Http\Requests\StoreMediaRequest;
use ErpMediaPackage\Http\Resources\MediaCollection;
use ErpMediaPackage\Http\Resources\MediaResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

final class MediaController extends Controller
{
    public function __construct(private readonly MediaServiceInterface $mediaService)
    {
    }

    public function store(StoreMediaRequest $request): MediaResource
    {
        $payload = MediaData::fromStoreRequest($request->validated());

        $media = $this->mediaService->create($payload);

        return new MediaResource($media);
    }

    public function index(): MediaCollection
    {
        $media = $this->mediaService->list();

        return new MediaCollection($media);
    }

    public function destroy(DestroyMediaRequest $request, string $id): JsonResponse
    {
        $this->mediaService->delete($id);

        return response()->json([
            'data' => [
                'type' => 'media',
                'id' => $id,
            ],
            'meta' => [
                'message' => 'Media deleted successfully.',
            ],
        ]);
    }
}
