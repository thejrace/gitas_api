<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RouteIntersection
 *
 * @property int $id
 * @property int $active_route
 * @property int $intersected_route
 * @property int $direction
 * @property string $stop_name
 * @property int $total_diff
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteIntersection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteIntersection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteIntersection query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteIntersection whereActiveRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteIntersection whereDirection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteIntersection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteIntersection whereIntersectedRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteIntersection whereStopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteIntersection whereTotalDiff($value)
 * @mixin \Eloquent
 *
 * @property int $active_route_id
 * @property int $intersected_route_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteIntersection whereActiveRouteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteIntersection whereIntersectedRouteId($value)
 *
 * @property-read \App\Route $activeRoute
 * @property-read \App\Route $intersectedRoute
 */
class RouteIntersection extends Model
{
    protected $fillable = [
        'active_route_id',
        'intersected_route_id',
        'direction',
        'stop_name',
        'total_diff',
    ];

    public $timestamps = false;

    public function activeRoute()
    {
        return $this->belongsTo(Route::class);
    }

    public function intersectedRoute()
    {
        return $this->belongsTo(Route::class);
    }
}
