<?php

namespace App;

use App\Product;
use App\BillItem;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable= ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function bill_items()
    {
        return $this->hasManyThrough(BillItem::class, Product::class);
    }
}