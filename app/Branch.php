<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    protected $table = 'branches';

    public $primaryKey = 'branch_id';
    public $timestamps = true;

    public function location() {
      return $this->belongsTo('App\Location');
    }

    public function bank() {
      return $this->belongsTo('App\Bank');
    }    
}
