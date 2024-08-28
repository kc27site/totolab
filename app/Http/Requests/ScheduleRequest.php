<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Team;

class ScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'no' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'toto' => 'nullable|string',
            'mini_toto_a' => 'nullable|string',
            'mini_toto_b' => 'nullable|string',
            'toto_goal3' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'no.required' => 'スケジュール番号は必須です。',
            'start_date.required' => '開始日は必須です。',
            'end_date.after_or_equal' => '終了日は開始日以降の日付でなければなりません。',
            'team_missing' => ':team_name は存在しません。',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (empty($this->toto) && empty($this->mini_toto_a) && empty($this->mini_toto_b) && empty($this->toto_goal3)) {
                $validator->errors()->add('at_least_one_required', 'toto、mini toto A、mini toto B、toto GOAL3のいずれかを入力してください。');
            }
            $teams = Team::get()->keyBy('name')->toArray();
            $this->validateTeams($validator, 'toto', $teams);
            $this->validateTeams($validator, 'mini_toto_a', $teams);
            $this->validateTeams($validator, 'mini_toto_b', $teams);
            $this->validateTeams($validator, 'toto_goal3', $teams);
        });
    }

    private function validateTeams($validator, $field, $teams)
    {
        if ($this->$field) {
            $lines = explode("\n", trim($this->$field));
            foreach ($lines as $line) {
                $parts = explode(',', $line);
                if (count($parts) === 3) {
                    $homeTeamName = trim($parts[1]);
                    $awayTeamName = trim($parts[2]);

                    if (!isset($teams[$homeTeamName])) {
                        $validator->errors()->add($field, "$homeTeamName は存在しません。");
                    }

                    if (!isset($teams[$awayTeamName])) {
                        $validator->errors()->add($field, "$awayTeamName は存在しません。");
                    }
                }
            }
        }
    }
}
