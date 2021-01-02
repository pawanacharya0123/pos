@extends('layouts.main')

@section('content')
	<table>
		<thead>
			<tr>
				<td>Product Name</td>
				<td>Category Name</td>
				<td>Price</td>
				<td>Qantity</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{$product->name}}</td>
			 	<td>{{$product->category->name}}</td>
		        <td>Rs.{{$product->price}}/{{$product->unit}}</td>
		        <td>{{$product->quantity}} {{$product->unit}}s</td>
			</tr>
		</tbody>
	</table>
	<br>
	@foreach ($product->product_histories as $product_history)
	<tr>
		<td>{{$product_history->statement}}</td>
		<br>
	</tr>
	@endforeach
@endsection

@section('scripts')
  
@endsection
