<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';
    protected $fillable = ['promotionname','promotiontype','discount','startdate','enddate'];
}
