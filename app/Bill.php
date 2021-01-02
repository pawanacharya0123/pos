<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BillItem;

class Bill extends Model
{
    protected $guarded = [];

    public function bill_items()
    {
        return $this->hasMany(BillItem::class);
    }

    // public function products()
    // {
    //     return $this->hasManyThrough(Product::class, BillItem::class);
    // }

    public function getFewProductAttribute(){
    	$names= '';
    	foreach ($this->bill_items as $bill_item) {
    			$names.= $bill_item->product->name. ' ';
    	}
    	return $names;
    }

}
