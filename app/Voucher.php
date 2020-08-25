<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    Protected $fillable = [
        'amount', 'exp'
   ];
}
