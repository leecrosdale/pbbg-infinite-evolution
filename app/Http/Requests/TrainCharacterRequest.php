<?php

namespace App\Http\Requests;

use App\Enums\TrainingType;
use Illuminate\Foundation\Http\FormRequest;

class TrainCharacterRequest extends FormRequest
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
                'in:' . implode(',', TrainingType::$trainingTypes),
            ],
        ];
    }
}
