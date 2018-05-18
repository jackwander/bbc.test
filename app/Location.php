<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    public $primaryKey = 'location_id';
    public $timestamps = true;
    
    public function branches() {
        return $this->hasMany('App\Branch');
    }    
}
