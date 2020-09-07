<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryCount extends Model
{
    protected $fillable = ['reference', 'outlet'];
}
