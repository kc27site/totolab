<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'schedule_no' => 'nullable|integer',
            'title' => 'required|string|max:255',
            'type' => 'required|integer',
            'status' => 'required|integer|in:1,2,3',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'schedule_no.integer' => 'Schedule No must be an integer.',
            'title.required' => 'Title is required.',
            'type.required' => 'Type is required.',
            'type.integer' => 'Type must be an integer.',
            'status.required' => 'Status is required.',
            'status.integer' => 'Status must be an integer.',
            'status.in' => 'Status must be one of: 1 (Draft), 2 (Published), 3 (Unpublished).',
        ];
    }
}
