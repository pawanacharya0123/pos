<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BillItem;
use App\Category;
use App\ProductHistory;

class Product extends Model
{
	protected $guarded = [];
	
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bill_items()
    {
        return $this->hasMany(BillItem::class);
    }

    public function product_histories()
    {
        return $this->hasMany(ProductHistory::class)->orderByDesc('created_at');;
    }
}
