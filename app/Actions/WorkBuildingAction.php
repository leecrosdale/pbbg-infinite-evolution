<?php

namespace App\Actions;

use App\Calculator\WorkBuildingCalculator;

class WorkBuildingAction
{
    public function __construct(
        private WorkBuildingCalculator $calculator,
    )
    {
    }

    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }
}
