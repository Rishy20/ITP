<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'first_name','last_name','company_name','address','city','email','phone_no'
    ];
}
