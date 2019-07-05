<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBusDefinition extends Model
{

    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function bus()
    {
		return $this->belongsTo(Bus::class);
    }
}
