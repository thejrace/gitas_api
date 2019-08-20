<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PermissionType
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermissionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermissionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermissionType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermissionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermissionType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermissionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermissionType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermissionType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PermissionType extends Model
{
    //

    protected $guarded = [];
}
