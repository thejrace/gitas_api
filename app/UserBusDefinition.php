<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserBusDefinition
 *
 * @property int $id
 * @property int $user_id
 * @property int $bus_id
 * @property-read \App\Bus $bus
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserBusDefinition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserBusDefinition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserBusDefinition query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserBusDefinition whereBusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserBusDefinition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserBusDefinition whereUserId($value)
 * @mixin \Eloquent
 */
class UserBusDefinition extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function bus()
    {
        return $this->hasOne(Bus::class);
    }
}