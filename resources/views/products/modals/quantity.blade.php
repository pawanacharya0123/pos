<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Update Quantity</h5>
    <br>
    Product Name: {{$product->name}}
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form action="{{route('products.updateQuantity', ['product'=> $product->id])}}" method="POST">
      @csrf
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">Remaining Quantity:</label>
        <input type="number" class="form-control" id="remaining_quantity"  value="{{$product->quantity}}" readonly="">
      </div>
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">Increase or Decrease??:</label>
        <select class="form-control" id="add_or_subract" name="add_or_subract" onchange="inc_or_dec($(this))">
          <option value="add" selected="">+</option>
          <option value="subract">-</option>
        </select>
      </div>
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">Amount:</label>
        <input type="number" class="form-control" id="change_quantity"  value="0" onkeyup="quantityChanged($(this))">
      </div>
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">Total Quanity:</label>
        <input type="number" class="form-control" id="total_quantity" name="quantity" value="{{$product->quantity}}" readonly="">
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  function inc_or_dec(this_element){
    quantityChanged($('#change_quantity'));
  }   

  function quantityChanged(this_element){
    var change_quantity= parseInt(this_element.val());
    var remaining_quantity= parseInt($('#remaining_quantity').val());
    // debugger;
    if(!(change_quantity>= 0)){
      $('#total_quantity').val(remaining_quantity);
      return false;
    }
    if($('#add_or_subract').val()== 'add'){
      var total_quantity= remaining_quantity + change_quantity;
    }else{
      var total_quantity= remaining_quantity - change_quantity;
    }
    $('#total_quantity').val(total_quantity);
  }
</script>