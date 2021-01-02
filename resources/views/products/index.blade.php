@extends('layouts.main')

@section('content')
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productModal" data-whatever="@mdo">Add new Product</button>
    <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Product Category</th>
                      <th>Price per Unit </th>
                      <th>Quantity Left</th>
                      <th>Quantity Sold</th>
                      <th>Amount Collected</th>
                      <th>Created Date</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($products as $product)
                      <tr>
                        <td> <a href="{{route('products.show', ['product'=> $product->id])}}"> {{$product->name}} </a> </td>
                        <td>{{$product->category->name}}</td>
                        <td>
                          Rs.{{$product->price}}/{{$product->unit}}
                          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#priceUpdate" data-whatever="{{$product->id}}">Update Price</button>
                        </td>
                        <td>
                          {{$product->quantity}} {{$product->unit}}s
                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#quantityUpdate" data-whatever="{{$product->id}}">Update Quantity</button>
                        </td>
                        <td>{{$product->bill_items()->sum('quantity')}} {{$product->unit}}s</td>
                        <td>Rs. {{$product->bill_items()->sum(\DB::raw('bill_items.price * bill_items.quantity'))}}</td>
                        <td>{{$product->created_at->diffForHumans()}}</td>
                        <td></td>
                        <td></td>
                      {{-- <td><span class="badge badge-success">Shipped</span></td> --}}
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
            
            <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                @include('products.partials.add')
              </div>
            </div>

            <div class="modal fade" id="priceUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                {{-- @include('products.modals.price') --}}
              </div>
            </div>

            <div class="modal fade" id="quantityUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                {{-- @include('products.modals.quantity') --}}
              </div>
            </div>
@endsection

@section('scripts')
  @if ($errors->any())
    <script type="text/javascript">
      $('#productModal').modal('show');      
    </script>
  @endif

  <script type="text/javascript">
    $('#priceUpdate').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); 
      var recipient = button.data('whatever');
      var url = '{{ route("products.editPrice", ":product") }}';
      url = url.replace(':product', recipient);
      $.get( url , function( html ) {
          var modal = $("#priceUpdate");
          modal.find('div.modal-dialog').html(html);
      });
    });

    $('#quantityUpdate').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); 
      var recipient = button.data('whatever');
      var url = '{{ route("products.editQuantity", ":product") }}';
      url = url.replace(':product', recipient);
      $.get( url , function( html ) {
          var modal = $("#quantityUpdate");
          modal.find('div.modal-dialog').html(html);
      });
    })
  </script>
@endsection
