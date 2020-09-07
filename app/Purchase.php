<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchase';

    protected $fillable =['vendorID','date','expectedDate','qty','supplyPrice','note'];
}
