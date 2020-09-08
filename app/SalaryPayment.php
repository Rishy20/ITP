<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryPayment extends Model
{
    protected $table = 'salary_payment';

    protected $fillable =['id','staffID','amount','date'];
}
