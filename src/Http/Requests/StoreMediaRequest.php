<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimetypes:image/jpeg,image/png,image/webp,application/pdf'],
            'directory' => ['nullable', 'string', 'max:255'],
        ];
    }
}
