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
          <th>Products</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($bills as $bill)
            <tr>
              <td> <a href="{{route('bills.show', ['bill'=> $bill->id])}}"> {{$bill->created_at->diffForHumans()}} </a></td>
              <td>{{$bill->total_amount}}</td>
              <td>{{$bill->discount}}</td>
              <td>{{$bill->vat}}</td>
              <td>{{$bill->few_product}}</td>
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
