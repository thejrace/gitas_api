<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Service
 *
 * @property int $id
 * @property int $type
 * @property string $name
 * @property int $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service whereSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service whereType($value)
 * @mixin \Eloquent
 * @property string $api_token
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service whereApiToken($value)
 * @property int $interval
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service whereInterval($value)
 * @property string|null $settings
 * @property-read int|null $notifications_count
 */
class Service extends Authenticatable
{
    use Notifiable;

    protected $guard = 'service';

    public $timestamps = false;

    protected $fillable = [
        'type',
        'name',
        'status',
        'api_token',
        'settings',
    ];
}
