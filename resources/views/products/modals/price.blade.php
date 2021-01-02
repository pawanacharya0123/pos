<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Update Price</h5>
      <br>
      Product Name: {{$product->name}}
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form action="{{route('products.updatePrice', ['product'=> $product->id])}}" method="POST">
      @csrf
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">Current Price:</label>
        <input type="text" class="form-control" id="recipient-name" value="{{$product->price}}" readonly="">
      </div>
      
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">New/Updated Price:</label>
        <input type="number" class="form-control" id="recipient-name" name="price" placeholder="New Price per unit {{$product->unit}}" required="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </form>
  </div>
</div>