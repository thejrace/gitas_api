<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ROUTE_SCANNER()
 * @method static static ROUTE_BOT()
 * @method static static ROUTE_STOP_BOT()
 * @method static static ROUTE_INTERSECTION_BOT()
 */
final class ServiceType extends Enum
{
    const ROUTE_SCANNER          = 0;
    const ROUTE_BOT              = 1;
    const ROUTE_STOP_BOT         = 2;
    const ROUTE_INTERSECTION_BOT = 3;
}
