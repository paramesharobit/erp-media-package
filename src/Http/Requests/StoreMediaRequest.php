<?php

declare(strict_types=1);

namespace ErpMediaPackage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class StoreMediaRequest extends FormRequest
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
            'file' => ['required', 'file', 'mimes:jpg,jpeg,png,gif,webp,pdf,mp4,mov', 'max:20480'],
            'collection' => ['nullable', 'string', 'max:100'],
            'name' => ['nullable', 'string', 'max:255'],
        ];
    }
}
