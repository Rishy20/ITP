<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

   Protected $fillable = [
        'fname', 'lname', 'nic', 'address', 'mobile', 'home', 'birthday', 'joined_date', 'target', 'salary',
       'salary_type', 'commission'
   ];
}
