<?php

namespace App\Http\Requests\Models;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Class LinkStoreRequest
 *
 * @package App\Http\Requests\Models
 */
class LinkStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'url' => [
                'required',
                'string',
                Rule::unique('links')->where(function ($query) {
                    return $query->where('user_id', auth()->user()->id);
                }),
            ],
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'lists' => 'nullable',
            'tags' => 'nullable',
            'is_private' => 'sometimes|boolean',
            'check_disabled' => 'sometimes|boolean',
        ];
    }
}
