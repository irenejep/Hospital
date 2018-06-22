<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $primaryKey = 'patient_id';
    public function visit(){
        return $this->hasMany('App\Visit');
    }
}
