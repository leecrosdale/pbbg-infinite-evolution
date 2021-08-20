<?php

namespace App\Http\Requests;

use App\Actions\TrainingAction;
use Illuminate\Foundation\Http\FormRequest;

class TrainingActionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'energy' => [
                'required',
                'integer',
                'min:1',
            ],
            'type' => [
                'required',
                'in:' . implode(',', TrainingAction::$validTrainingTypes),
            ],
        ];
    }
}
