<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorPayment extends Model
{
    protected $table = 'vendor_payment';

    protected $fillable =['id','vendorID','paymentType','bankID','amount','date'];
}
