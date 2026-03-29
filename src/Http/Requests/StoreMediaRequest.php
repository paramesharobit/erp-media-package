<?php

declare(strict_types=1);

namespace Arobit\ErpMedia\Http\Requests;

use Arobit\ErpMedia\DTOs\StoreMediaData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'max:10240'],
            'disk' => ['nullable', 'string'],
            'directory' => ['nullable', 'string'],
            'visibility' => ['nullable', Rule::in(['public', 'private'])],
        ];
    }

    public function toDto(): StoreMediaData
    {
        return new StoreMediaData(
            file: $this->file('file'),
            disk: $this->input('disk', config('erp-media.disk')),
            directory: $this->input('directory', config('erp-media.directory')),
            visibility: $this->input('visibility', config('erp-media.visibility')),
        );
    }
}
