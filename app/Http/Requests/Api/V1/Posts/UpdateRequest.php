<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Posts;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'nullable',
                'string',
                'max:255'
            ],
            'body' => [
                'nullable',
                'string'
            ],
            'description' => [
                'nullable',
                'string',
                'max:120'
            ],
            'published' => [
                'nullable',
                'boolean'
            ]
        ];
    }
}
