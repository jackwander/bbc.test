<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userbranch extends Model
{
    protected $table = 'userbranches';
    public $primaryKey = 'userbranch_id';
    public $timestamps = true;
    
    public function branches() {
        return $this->belongsTo('App\Branch');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
}
