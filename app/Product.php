<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'productpromotions';
    protected $fillable = ['promotionid','productid'];
}
