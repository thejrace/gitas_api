<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppModulePermission extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function appModule(){
        return $this->belongsTo(AppModule::class);
    }

}
