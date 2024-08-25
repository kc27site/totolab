<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $teamId = $this->route('team') ? $this->route('team')->id : null;
        return [
            'category' => 'required|in:1,2,3,4',
            'name' => 'required|string|max:255|unique:teams,name,' . $teamId,
        ];
    }

    public function messages()
    {
        return [
            'category.in' => 'The category must be J1, J2, J3, or その他.',
            'name.required' => 'The team name is required.',
            'name.unique' => 'このチーム名は既に存在します。',
        ];
    }
}
