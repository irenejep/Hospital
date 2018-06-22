<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    //
    protected $primaryKey= 'visit_id';
    public function patient(){
        return $this->belongsTo('App\Patient');
    }
}
