<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Services;

use Erp\MediaPackage\Contracts\MediaServiceInterface;
use Erp\MediaPackage\DTO\MediaUploadData;
use Erp\MediaPackage\Models\Media;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

class MediaService implements MediaServiceInterface
{
    public function upload(MediaUploadData $uploadData): Media
    {
        $disk = $uploadData->disk ?? 'public';
        $directory = trim((string) $uploadData->directory, '/');
        $file = $uploadData->file;

        $extension = $file->extension();
        $filename = (string) Str::uuid() . ($extension !== '' ? '.' . $extension : '');
        $storedPath = $file->storeAs($directory, $filename, $disk);

        if ($storedPath === false) {
            throw new RuntimeException('Failed to store uploaded file.');
        }

        try {
            /** @var Media $media */
            $media = DB::transaction(static function () use ($file, $disk, $directory, $filename, $storedPath, $extension): Media {
                return Media::query()->create([
                    'disk' => $disk,
                    'directory' => $directory,
                    'original_name' => $file->getClientOriginalName(),
                    'filename' => $filename,
                    'path' => $storedPath,
                    'mime_type' => $file->getClientMimeType(),
                    'extension' => $extension,
                    'size' => $file->getSize(),
                ]);
            });
        } catch (Throwable $exception) {
            Storage::disk($disk)->delete($storedPath);
            throw $exception;
        }

        return $media;
    }

    public function safeDelete(string $mediaId): bool
    {
        return DB::transaction(static function () use ($mediaId): bool {
            /** @var Media|null $media */
            $media = Media::query()->lockForUpdate()->find($mediaId);

            if ($media === null) {
                return false;
            }

            $disk = $media->disk;
            $path = $media->path;

            if (Storage::disk($disk)->exists($path) && ! Storage::disk($disk)->delete($path)) {
                throw new RuntimeException('Failed to delete media file from disk.');
            }

            return (bool) $media->delete();
        });
    }
}
