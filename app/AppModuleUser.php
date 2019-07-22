<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppModuleUser extends Model
{

    protected $guarded = [];
    protected $hidden = [
        'password'
    ];


    public $timestamps = false;
    public function AppModule(){
        return $this->belongsTo(AppModule::class);
    }
}
