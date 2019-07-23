<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class AppModuleUser extends Authenticatable
{

    use Notifiable, HasRoles;

    protected $guard_name = 'app_module_user';
    protected $guarded = [];
    protected $hidden = [
        'password'
    ];


    public $timestamps = false;
    public function AppModule(){
        return $this->belongsTo(AppModule::class);
    }
}
