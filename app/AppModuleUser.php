<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppModuleUser extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public function AppModule(){
        return $this->belongsTo(AppModule::class);
    }
}
