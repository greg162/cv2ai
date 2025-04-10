<?php

namespace App\Features\Checks;

use App\Features\Checks\CheckRegistery;

class CheckController
{

    static function listAllChecks(): array
    {
        $returnData = [];
        foreach (CheckRegistery::cases() as $check) {
            $checkClass = $check->getClass();
            $checkClass = class_basename($checkClass);
            $returnData[] = [
                'id' => $check->value,
                'name' => $check->getName(),
                'description' => $check->getDescription(),
                'icon' => $check->getIcon(),
                'directoryName' => $checkClass,
            ];
        }
        return $returnData;
    }
}