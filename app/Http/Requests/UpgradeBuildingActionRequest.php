<?php

namespace App\Http\Requests;

use App\Actions\UpgradeBuildingAction;
use Illuminate\Foundation\Http\FormRequest;

class UpgradeBuildingActionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'building_type' => [
                'required',
                'in:' . implode(',', UpgradeBuildingAction::$validBuildingTypes),
            ],
        ];
    }
}
