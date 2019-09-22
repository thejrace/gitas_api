<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RouteScannerUserConnections
 *
 * @property int $id
 * @property int $route_scanner_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\RouteScanner $routeScanners
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScannerUserConnections newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScannerUserConnections newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScannerUserConnections query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScannerUserConnections whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScannerUserConnections whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScannerUserConnections whereRouteScannerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScannerUserConnections whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteScannerUserConnections whereUserId($value)
 * @mixin \Eloquent
 */
class RouteScannerUserConnections extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'route_scanner_id'];

    public function routeScanners()
    {
        return $this->hasOne(RouteScanner::class);
    }
}
