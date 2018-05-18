<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'banks';

    public $primaryKey = 'bank_id';
    public $timestamps = true;
}
