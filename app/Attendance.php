<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    Protected $fillable = [
        'id', 'e_id', 'attendance', 'date', 'in', 'out'
   ];
}
