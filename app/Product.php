<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'pcode';
    protected $keyType = 'String';
    public $incrementing = false;
}
