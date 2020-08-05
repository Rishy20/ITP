<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['pcode','name','description','brand','catID','sellingPrice','costPrice','discount','Qty','reorder_level','supplierId','barcode'];
}
