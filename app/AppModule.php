<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppModule extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function users(){
        return $this->hasMany(AppModuleUser::class);
    }

}
