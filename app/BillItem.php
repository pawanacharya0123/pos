<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bill;
use App\Product;

class BillItem extends Model
{
    protected $guarded = [];

     public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
