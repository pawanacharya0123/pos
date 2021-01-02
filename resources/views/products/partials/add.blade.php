<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Create new Product</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form action="{{route('products.store')}}" method="POST">
      @csrf
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">Name:</label>
        <input type="text" class="form-control {{$errors->has('name')?'is-invalid':''}}" id="recipient-name" name="name" value="{{old('name')}}">
        @if ($errors->has('name'))
          <div class="invalid-feedback">
            {{$errors->first('name')}}
          </div>
        @endif
      </div>
      {{-- <div class="form-group">
        <label for="recipient-name" class="col-form-label">Code:</label>
        <input type="text" class="form-control {{$errors->has('code')?'is-invalid':''}}" id="recipient-name" name="code"  value="{{old('code')}}">
        @if ($errors->has('name'))
          <div class="invalid-feedback">
            {{$errors->first('name')}}
          </div>
        @endif
      </div> --}}
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">Quantity:</label>
        <input type="text" class="form-control" id="recipient-name" name="quantity" value="{{old('quantity')}}">
      </div>
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">Unit:</label>
        <input type="text" class="form-control" id="recipient-name" name="unit" value="{{old('unit')}}">
      </div>
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">Price per Unit:</label>
        <input type="text" class="form-control" id="recipient-name" name="price" value="{{old('price')}}">
      </div>
      {{-- <div class="form-group">
        <label for="recipient-name" class="col-form-label">Discount:</label>
        <input type="text" class="form-control" id="recipient-name" name="name">
      </div> --}}
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">Category name:</label>
        <select class="form-control" name="category_id">
        	@foreach ($categories as $category)
        		<option value="{{$category->id}}" 
              @if ($errors->any())
                {{old('category_id')== $category->id? 'selected': ''}}
              @endif
            >{{$category->name}}</option>
        	@endforeach
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </form>
  </div>
</div>