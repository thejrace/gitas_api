<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RouteScanner
 *
 * @property int $id
 * @property int $status
 * @property string $code
 * @property string $settings
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScanner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScanner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScanner query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScanner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScanner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScanner whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScanner whereSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScanner whereStatus($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScanner whereCode($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RouteScannerUserConnections[] $connections
 * @property-read int|null $connections_count
 */
class RouteScanner extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'settings', 'status',
    ];

    public function connections()
    {
        return $this->hasMany(RouteScannerUserConnections::class);
    }
}
