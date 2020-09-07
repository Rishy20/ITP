<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loyalty extends Model
{
    protected $table = 'loyalty';

    protected $fillable =['loyaltyName','minimumPointRequired','tierPoints','points'];

   
}
