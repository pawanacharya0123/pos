<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class ProductHistory extends Model
{
	protected $guarded = [];
	
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
