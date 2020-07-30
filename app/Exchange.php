<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $table = 'exchanges';
    protected $fillable =['exchangeID','productID','customerID','salesmanID','amount','date'];
}
