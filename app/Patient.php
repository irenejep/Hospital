<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    
    protected $primaryKey = 'patient_id';

    public $full_name;

    public function visit(){
        return $this->hasMany('App\Visit');
    }
    public function setFirstName($firstName){
        $this->full_name = $firstName;
        }
        public function getFirstName(){
        return 'Mary';
        }
}
