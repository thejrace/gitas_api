<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Route
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RouteIntersection[] $intersections
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RouteStop[] $stops
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Route newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Route newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Route query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Route whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Route whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Route whereName($value)
 * @mixin \Eloquent
 * @property-read int|null $intersections_count
 * @property-read int|null $stops_count
 */
class Route extends Model
{
    protected $fillable = [
        'code', 'name',
    ];

    public $timestamps = false;

    public function stops()
    {
        return $this->hasMany(RouteStop::class);
    }

    public function intersections()
    {
        return $this->hasMany(RouteIntersection::class);
    }
}
