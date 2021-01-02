@extends('layouts.main')

@section('content')
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryModal" data-whatever="@mdo">Add new Category</button>
    <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Category Name</th>
                      <th>Products Count</th>
                      <th>Quantity Sold</th>
                      <th>Amount Collected</th>
                      <th>Created Date</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                      <tr>
                        <td> <a href="{{route('categories.show', ['category'=> $category->id])}}"> {{$category->name}} </a> </td>
                        <td>{{$category->products()->count()}}</td>
                        <td>{{$category->bill_items()->sum('bill_items.quantity')}} Units</td>
                        <td>Rs.{{$category->bill_items()->sum(\DB::raw('bill_items.price * bill_items.quantity'))}}</td>
                        <td>{{$category->created_at->diffForHumans()}}</td>
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
            
            <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                @include('categories.partials.add')
              </div>
            </div>
@endsection

@section('scripts')
  @if ($errors->any())
    <script type="text/javascript">
      $('#categoryModal').modal('show');      
    </script>
  @endif
@endsection
