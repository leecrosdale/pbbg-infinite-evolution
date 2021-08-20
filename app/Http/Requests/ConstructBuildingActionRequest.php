<?php

namespace App\Http\Requests;

use App\Actions\ConstructBuildingAction;
use Illuminate\Foundation\Http\FormRequest;

class ConstructBuildingActionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'building_type' => [
                'required',
                'in:' . implode(',', ConstructBuildingAction::$validBuildingTypes),
            ],
        ];
    }
}
