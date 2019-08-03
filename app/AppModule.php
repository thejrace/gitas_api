<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\AppModule
 *
 * @property int $id
 * @property string $name
 * @property string $api_token
 * @property string|null $permission_prefix
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AppModuleUser[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModule permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModule query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModule role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModule whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModule whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModule whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModule wherePermissionPrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModule whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AppModule extends Authenticatable
{

    use Notifiable, HasRoles;

    protected $guard = 'app_module';
    protected $guarded = [];

    public function users(){
        return $this->hasMany(AppModuleUser::class);
    }

}
