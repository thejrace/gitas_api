<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RouteStop
 *
 * @property int $id
 * @property \App\Route $route
 * @property int $direction
 * @property int $no
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteStop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteStop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteStop query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteStop whereDirection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteStop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteStop whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteStop whereNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteStop whereRoute($value)
 * @mixin \Eloquent
 * @property int $route_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RouteStop whereRouteId($value)
 */
class RouteStop extends Model
{
    protected $fillable = [
        'direction',
        'no',
        'name',
        'route_id',
    ];

    public $timestamps = false;

    public function route()
    {
        return $this->belongsTo('App\Route');
    }
}
