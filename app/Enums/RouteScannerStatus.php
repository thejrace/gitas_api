<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RouteScannerStatus extends Enum
{
    const STOPPED = 0;
    const ACTIVE  = 1;

    public static function getDescription($value): string
    {
        if ($value === self::ACTIVE) {
            return 'Çalışıyor';
        } elseif ($value === self::STOPPED) {
            return 'Durdurulmuş';
        }

        return parent::getDescription($value);
    }
}
