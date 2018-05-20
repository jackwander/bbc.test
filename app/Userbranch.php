<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userbranch extends Model
{
    protected $table = 'userbranches';
    public $primaryKey = 'userbranch_id';
    public $timestamps = true;
    
    public function branches() {
        return $this->hasMany('App\Branch');
    }
}
