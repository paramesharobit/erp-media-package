<?php

declare(strict_types=1);

namespace ErpMediaPackage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class DestroyMediaRequest extends FormRequest
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
            'id' => ['required', 'uuid'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function validationData(): array
    {
        return array_merge($this->all(), [
            'id' => $this->route('id'),
        ]);
    }
}
