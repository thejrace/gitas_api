<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\AppModuleUser
 *
 * @property int $id
 * @property int $app_module_id
 * @property string $name
 * @property string $email
 * @property string|null $password
 * @property string $api_token
 * @property-read \App\AppModule $AppModule
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModuleUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModuleUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModuleUser permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModuleUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModuleUser role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModuleUser whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModuleUser whereAppModuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModuleUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModuleUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModuleUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AppModuleUser wherePassword($value)
 * @mixin \Eloquent
 */
class AppModuleUser extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guard = 'app_module_user';

    protected $guarded = [];

    protected $hidden = [
        'password',
        'api_token',
    ];

    public $timestamps = false;

    public function AppModule()
    {
        return $this->belongsTo(AppModule::class);
    }
}
