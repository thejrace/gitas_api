<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Bus
 *
 * @property int $id
 * @property string $active_plate
 * @property string $official_plate
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bus whereActivePlate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bus whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bus whereOfficialPlate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Bus extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'active_plate', 'official_plate', 'code',
    ];

    //protected $appends = ['defined']; //Make it available in the json response
}
