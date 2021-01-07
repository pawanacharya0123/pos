<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Bill;
use DB, Auth;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Product::all();
        return view('check_outs.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $big_array = array();
        $sub_total= 0;
        foreach ($request->product_id as $key => $value) {
            $array_temp= array(
                'product_id'=> $value,
                'price'=> $request->price_per_unit[$key],
                'quantity'=>$request->quantity[$key],
            );
            $product= Product::findOrFail($array_temp['product_id']);

            $product->product_histories()->create([
                'user_id'=> Auth::id(),
                'statement'=> ' '.$product->name .' is checkedout with price '.$array_temp['price'] .'/'. $product->unit .' with quanitiy '. $array_temp['quantity']. ' '.$product->unit .' by '. Auth::user()->name. '.',
            ]);

            $product->quantity-= $array_temp['quantity'];
            $product->save();

            $sub_total+= ($array_temp['price']* $array_temp['quantity']);
            array_push($big_array, $array_temp);
        }
        $vat= $sub_total*($request['vat_percent']/100);
        $total_after_vat= $sub_total+ $vat;
        $discount= 0;
        if($request['discount']){
            $discount= ($request['amount_or_percent']=='Percent')? ($request['discount']*$total_after_vat/100): $request['discount']; 
        }
        $total_amount= $total_after_vat- $discount;

        $bill= Bill::create([
            'total_amount'=> $total_amount,
            'discount'=> $discount,
            'vat'=> $vat,
        ]);
        $bill->bill_items()->createMany($big_array);
        DB::commit();
        return redirect()->route('bills.show', ['bill'=> $bill->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
