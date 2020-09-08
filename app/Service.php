<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    protected $fillable = [
        'id','customer_id','date','service_description','return_date','cost'
    ];


}
