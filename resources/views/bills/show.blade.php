@extends('layouts.main')

@section('content')
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table m-0">
        <thead>
        <tr>
          <th>Bill date</th>
          <th>Total amount</th>
          <th>Discount amount</th>
          <th>VAT amount</th>
          {{-- <th>Products</th> --}}
          <th>Edit</th>
          <th>Delete</th>
        </tr>
        </thead>
        <tbody>
            <tr>
              <td>{{$bill->created_at->diffForHumans()}}</td>
              <td>{{$bill->total_amount}}</td>
              <td>{{$bill->discount}}</td>
              <td>{{$bill->vat}}</td>
              {{-- <td>{{$bill->few_product}}</td> --}}
            </tr>
        
        </tbody>
      </table>
      <table>
      	<thead>
      		<tr>
      			<th>Product name</th>
      			<th>Product Price</th>
      			<th>Product Quantity</th>
      			<th>Total Amount</th>
      		</tr>
      	</thead>
      	<tbody>
      		@foreach ($bill->bill_items as $bill_item)
      			<tr>
	      			<td>{{$bill_item->product->name}}</td>
	      			<td>Rs. {{$bill_item->price}}/ {{$bill_item->product->unit}}</td>
	      			<td>{{$bill_item->quantity}} {{$bill_item->product->unit}}s</td>
	      			<td>Rs. {{$bill_item->price* $bill_item->quantity}} </td>
      			</tr>
      		@endforeach
      	</tbody>
      </table>
    </div>
    <!-- /.table-responsive -->
  </div>

@endsection

@section('scripts')
  
@endsection
