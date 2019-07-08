<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppModuleUserPermission extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function permission(){
        return $this->belongsTo(AppModulePermission::class);
    }

}
