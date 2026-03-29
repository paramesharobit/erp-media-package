<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Services;

use Erp\MediaPackage\Contracts\MediaRepositoryInterface;
use Erp\MediaPackage\Contracts\MediaServiceInterface;
use Erp\MediaPackage\DTO\MediaDTO;
use Erp\MediaPackage\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class MediaService implements MediaServiceInterface
{
    private const DEFAULT_DISK = 'public';

    public function __construct(private readonly MediaRepositoryInterface $mediaRepository)
    {
    }

    public function upload(MediaDTO $dto): Media
    {
        if (! $dto->file->isValid()) {
            throw new RuntimeException('Uploaded file is invalid.');
        }

        $id = (string) Str::uuid();
        $disk = config('media.disk', self::DEFAULT_DISK);
        $directory = trim((string) config('media.directory', 'media'), '/');

        /** @var FilesystemAdapter $storage */
        $storage = Storage::disk($disk);

        $extension = $dto->file->guessExtension() ?? $dto->file->getClientOriginalExtension() ?? 'bin';
        $filename = sprintf('%s.%s', $id, ltrim($extension, '.'));
        $path = $storage->putFileAs($directory, $dto->file, $filename);

        if ($path === false) {
            throw new RuntimeException('Failed to store uploaded file.');
        }

        return $this->mediaRepository->create([
            'id' => $id,
            'disk' => $disk,
            'path' => $path,
            'filename' => $dto->file->getClientOriginalName(),
            'mime_type' => $dto->file->getMimeType(),
            'extension' => $extension,
            'size' => $dto->file->getSize(),
            'type' => $dto->type,
            'related_model_type' => $dto->related_model_type,
            'related_model_id' => $dto->related_model_id,
        ]);
    }

    public function delete(string $id): bool
    {
        $media = $this->mediaRepository->findById($id);

        if ($media === null) {
            return false;
        }

        Storage::disk($media->disk)->delete($media->path);

        return $this->mediaRepository->delete($id);
    }

    public function attachToModel(string $mediaId, Model $model): Media
    {
        if ($model->getKey() === null) {
            throw new RuntimeException('Model must be persisted before attaching media.');
        }

        $updated = $this->mediaRepository->updateRelations(
            $mediaId,
            $model::class,
            (string) $model->getKey(),
        );

        if (! $updated instanceof Media) {
            throw new ModelNotFoundException('Media not found.');
        }

        return $updated;
    }
}
