<?php

namespace App\Http\Requests;

use App\Enums\BuildingType;
use Illuminate\Foundation\Http\FormRequest;

class UpgradeBuildingActionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'building_type' => [
                'required',
                'in:' . implode(',', BuildingType::$buildingTypes),
            ],
        ];
    }
}
