<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'sections' => 'required|array',
            'sections.*.id' => 'nullable|integer|exists:sections,id',
            'sections.*.type' => 'required|integer|in:1,2',
            'sections.*.content' => 'required|string',
            'sections.*.position' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'sections.required' => 'Sections are required.',
            'sections.*.type.required' => 'Section type is required.',
            'sections.*.content.required' => 'Section content is required.',
            'sections.*.position.required' => 'Section position is required.',
        ];
    }
}
