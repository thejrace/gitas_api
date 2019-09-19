<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static CUSTOM_SERVICE()
 * @method static static BOT()
 */
final class ServiceType extends Enum
{
    const CUSTOM_SERVICE = 0;
    const BOT            = 1;
}
