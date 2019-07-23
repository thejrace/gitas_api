<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AppModule extends Authenticatable
{

    use Notifiable, HasRoles;

    protected $guard_name = 'app_module';
    protected $guarded = [];
    protected $hidden = [
        'password'
    ];



    public function users(){
        return $this->hasMany(AppModuleUser::class);
    }

}
