<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RouteDirection extends Enum
{
    const FORWARD  = 0;
    const BACKWARD = 1;

    public static function getDescription($value): string
    {
        if ($value === self::FORWARD) {
            return 'Gidiş';
        } elseif ($value === self::BACKWARD) {
            return 'Dönüş';
        }

        return parent::getDescription($value);
    }
}
