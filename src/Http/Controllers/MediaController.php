<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Http\Controllers;

use Erp\MediaPackage\Contracts\MediaServiceInterface;
use Erp\MediaPackage\DTO\MediaUploadData;
use Erp\MediaPackage\Http\Requests\StoreMediaRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class MediaController extends Controller
{
    public function store(StoreMediaRequest $request, MediaServiceInterface $mediaService): JsonResponse
    {
        $media = $mediaService->upload(new MediaUploadData(
            file: $request->file('file'),
            disk: 'public',
            directory: (string) $request->input('directory', '')
        ));

        return response()->json([
            'data' => [
                'type' => 'media',
                'id' => $media->id,
                'attributes' => [
                    'disk' => $media->disk,
                    'directory' => $media->directory,
                    'original_name' => $media->original_name,
                    'filename' => $media->filename,
                    'path' => $media->path,
                    'mime_type' => $media->mime_type,
                    'extension' => $media->extension,
                    'size' => $media->size,
                ],
            ],
        ], 201);
    }

    public function destroy(string $media, MediaServiceInterface $mediaService): JsonResponse
    {
        $deleted = $mediaService->safeDelete($media);

        if (! $deleted) {
            return response()->json([
                'errors' => [[
                    'status' => '404',
                    'title' => 'Not Found',
                    'detail' => 'Media not found.',
                ]],
            ], 404);
        }

        return response()->json([
            'meta' => ['deleted' => true],
        ]);
    }
}
