<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function role(){
        return $this->belongsTo(EmployeeRole::class);
    }
    public function employementStatus(){
        return $this->belongsTo(EmploymentStatus::class);
    }
}
