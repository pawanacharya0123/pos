<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Auth;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Product::all();
        $categories= Category::all();
        return view('products.index', compact(['products', 'categories']));
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
        $validated = $request->validate([
            'name' => 'required|unique:products|max:255',
            // 'code' => 'nullable|unique:products|max:255',
            'quantity'=> 'required',
            'unit'=> 'required',
            'price'=> 'required',
            // 'discout'=> 'nullable',
            'category_id'=> 'required|exists:categories,id'
        ]);
        
        DB::beginTransaction();
        $category = Category::find($validated['category_id']);
        $product = $category->products()->create($validated);
        $product->product_histories()->create([
            'user_id'=> Auth::id(),
            'statement'=> 'A new Product '.$product->name .' is added with price '.$product->price .'/'. $product->unit .' with quanitiy '. $product->quantity. ' '.$product->unit .' by '. Auth::user()->name. '.',
        ]);
        DB::commit();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product= Product::findOrFail($id);
        return view('products.show', compact('product'));
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

    public function editPrice($id)
    {
        $product= Product::findOrFail($id);
        return view('products.modals.price', compact('product'));
    }

    public function updatePrice(Request $request, $id){
        $product= Product::findOrFail($id);
        DB::beginTransaction();

        $product->product_histories()->create([
            'user_id'=> Auth::id(),
            'statement'=> $product->name .' price is updated from Rs. '. $product->price .'  to Rs. '. $request['price'] .' per '. $product->unit .' by '. Auth::user()->name. '.',
        ]);

        $product->update([
            'price'=> $request['price']
        ]); 

        DB::commit();
        return redirect()->back();
    }

    public function editQuantity($id)
    {
        $product= Product::findOrFail($id);
        return view('products.modals.quantity', compact('product'));
    }

    public function updateQuantity(Request $request, $id){
        $product= Product::findOrFail($id);
        DB::beginTransaction();

        $inc_or_dec= ($request['quantity'] > $product->quantity )?'increased':'decresed';

        $product->product_histories()->create([
            'user_id'=> Auth::id(),
            'statement'=> $product->name .' quantity is ' . $inc_or_dec . ' from'. $product->quantity .'  to '. $request['quantity'] .'  '. $product->unit .'s by '. Auth::user()->name. '.',
        ]);

        $product->update([
            'quantity'=> $request['quantity']
        ]);

        DB::commit();
        return redirect()->back();
    }
}
