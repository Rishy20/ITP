<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['firstname','lastname','gender','dob','email','phone','streetaddress','city'];
}
