<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ServiceStatus extends Enum
{
    const ACTIVE = 1;
    const IDLE   = 0;

    public static function getDescription($value): string
    {
        if ($value === self::ACTIVE) {
            return 'Çalışıyor';
        } elseif ($value === self::IDLE) {
            return 'Beklemede';
        }

        return parent::getDescription($value);
    }
}
