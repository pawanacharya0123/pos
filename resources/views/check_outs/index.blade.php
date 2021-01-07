@extends('layouts.main')

@section('content')
			<div class="col-sm-12">
				<form method="POST" action="{{route('check_outs.store')}}">
				@csrf
                <div class="table-responsive">  
                  	<table class="table table-bordered" id="main_table">  
                        <tbody>
                          <tr>
                            <th>Product<span style="color: red">*</span></th>
                            <th >MRP</th>
                            <th >Rate</th>
                            <th >Qty.</th>
                            <th>Amount</th>
                            <th> <button type="button" name="add" id="add" class="btn btn-success" onClick="addProductRow($(this));">Add More</button></th>
                          </tr>
	                        <tr>

	                        	<td>
	                           
	                            <div class="input-group">
	                            <select class="form-control" onchange="allocateAll($(this));" name="product_id[]" required="">
	                                <option>Select Product </option>
	                                @foreach($products as $product)
	                                  <option value="{{$product->id}}" data-all="{{$product}}"> {{$product->name}} </option>
	                                @endforeach
	                            </select>
	                            </div>
	                          </td>
	                          <td >
	                            <div class="input-group mb-2">
	                                <div class="input-group-prepend">
	                                  <div class="input-group-text">Rs.</div>
	                                </div>
	                                <input type="text" class="form-control" id="mrp" placeholder="MRP" aria-label="Amount"  style="width:80px;" readonly="readonly" required>
	                                <div class="input-group-append">
	                                  <div class="input-group-text" id="per_unit">Per Unit</div>
	                                </div>
	                            </div>
	                          </td>
	                          <td>
	                            <div class="input-group ">
	                              <div class="input-group-prepend">
	                                {{-- <span class="input-group-text" id="">{{$deal->currency->symbol}}</span> --}}
	                              </div>
	                              <input type="number" class="form-control" id="rate" placeholder="Rate" aria-label="Rate" aria-describedby="" style="width:100px;" onkeyup="rateChange($(this));" name="price_per_unit[]" step="0.01" required>
	                            </div>                        
	                          </td>
	                          <td>
	                            <div class="input-group ">
	                              <div class="input-group-prepend" >
	                                <span class="input-group-text" id="" style="height: 100%;"><i class="fa fa-balance-scale" aria-hidden="true"></i></span>
	                              </div>
	                              <input type="number" class="form-control" id="qty" placeholder="Qty" aria-label="Qty" aria-describedby="" style="width:100px;" onkeyup="qtyChange($(this));"  name="quantity[]" step="0.01" required>
	                            </div>                        
	                          </td>
	                          <td>
	                            <div class="input-group ">
	                              <div class="input-group-prepend">
	                                {{-- <span class="input-group-text" id="">{{$deal->currency->symbol}}</span> --}}
	                              </div>
	                              <input type="text" class="form-control amount" id="amount" placeholder="0.00" aria-label="0.00" aria-describedby="" style="width:100px;" readonly="readonly" required>
	                            </div>                      
	                          </td>
	                          <td> 
	                            {{-- <button type="button" name="add" id="add" class="btn btn-success" onClick="addProductRow($(this));">Add More</button> --}}
	                            <button type="button" name="add" id="add" class="btn btn-danger" onClick="deleteProductRow($(this));" style="width:100%">X</button>
	                          </td>
	                        </tr>
                    	</tbody>
                	</table>
            	</div>
            <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group ">
                          {{-- <label for="">Order Notes</label> --}}
                          <div class="position-relative has-icon-left">
                            {{-- <textarea class="form-control" rows="8" id="order_note" placeholder="Order Notes" name="order_note" cols="50">{{ ($deal_products->isEmpty() ? "" : $deal_products->first()->order_notes) }}
                            </textarea> --}}
                            <div class="form-control-position">
                             {{-- <i class="fa fa-fw fa-file-text-o"></i> --}}
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group ">
                            <label for="total" class=" control-label">Sub Total</label>
                            <div class="input-group ">
                              <div class="input-group-prepend">
                                {{-- <span class="input-group-text" id="">{{$deal->currency->symbol}}</span> --}}
                              </div>
                              <input type="text" class="form-control" id="sub_total" placeholder="Rate" aria-label="Rate" aria-describedby="" readonly="readonly">
                            </div>
                        </div>

                         <div class="form-group " style="display: inline-block; width: 100%;">
                            <div class="row">
                                <label for="discount" class="col-sm-12 control-label">VAT</label>
                                <div class="col-sm-8">
                                    <div class="input-group" style="width: 100%;" id="discount_div">
                                        <input pattern="[0-9.]+" class="form-control discount onlynumber" id="vat_amount" placeholder="VAT Amount" name="vat" type="text"  readonly="">
                                    </div>
                                </div>
                                 <div class="col-sm-4 input-group">
                                        <input pattern="[0-9.]+" class="form-control discount onlynumber" id="vat_percent" placeholder="Discount" name="vat_percent" type="text" onkeyup="vat_added();" value="13">
                                         <div class="input-group-append">
		                                  <div class="input-group-text">%</div>
		                                </div>
                                    </select>
                                </div>              
                            </div>
                        </div>

                     
                        <div class="form-group " style="display: inline-block; width: 100%;">
                            <div class="row">
                                <label for="discount" class="col-sm-12 control-label">Discount</label>
                                <div class="col-sm-8">
                                    <div class="input-group" style="width: 100%;" id="discount_div">
                                        {{-- <span class="input-group-addon rs-symbol" id="for_amount">{{$deal->currency->symbol}}</span> --}}
                                        <input pattern="[0-9.]+" class="form-control discount onlynumber" id="discount" placeholder="Discount" name="discount" type="text" onkeyup="amount_discount();" >
                                    </div>
                                    
                                </div>
                                 <div class="col-sm-4">
                                    <select class="form-control" id="amount_person_select" onchange="amount_percent($(this));" name="amount_or_percent">
                                        <option value="Amount" selected>Amount </option>
                                        <option value="Percent" >Percent </option>
                                        {{-- <option value="Amount" {{ (($discounts_array[0] == 'Amount') ? "selected" : "") }}>Amount </option> --}}
                                        {{-- <option value="Percent" {{ (($discounts_array[0] == 'Percent') ? "selected" : "") }}>Percent </option> --}}
                                    </select>
                                </div>              
                            </div>
                        </div>

                       
                        <div class="form-group " >
                            <label for="total" class=" control-label">Total </label>
                            <div class="input-group">
                                {{-- <span class="input-group-addon rs-symbol">{{$deal->currency->symbol}}</span> --}}
                                <input class="form-control total" placeholder="Total Amount" readonly="readonly" name="total" type="text" id="total">
                            </div>
                        </div>    
            	<button type="submit" class="btn btn-success">CheckOut</button>
            </div>
            </form>
        </div>
@endsection

@section('scripts')
	<script type="text/javascript">
		function addProductRow(this_target){
		    var values={!! $products !!};
		   
		    
		    var table_tbody= $('table#main_table tbody');
		    var table_append= `<tr> <td>
		                      <div class="input-group">
		                      <select class="form-control" onchange="allocateAll($(this));"  name="product_id[]" required>
		                          <option>Select Product </option>`;
		    $.each( values, function( key, value ) {
		       table_append+= `<option value="`+value.id+`" data-all='`+JSON.stringify(value)+`'>`+value.name+`</option>`;
		    });
		    table_append+= ` </select>
		                      </div>
		                    </td>
		                    <td >
		                      <div class="input-group mb-2">
		                          <div class="input-group-prepend">
		                            <div class="input-group-text">Rs.</div>
		                          </div>
		                          <input type="text" class="form-control" id="mrp" placeholder="MRP" aria-label="Amount" style="width:80px;" readonly="readonly" required>
		                          <div class="input-group-append">
		                            <div class="input-group-text" id="per_unit">Per Unit</div>
		                          </div>
		                      </div>
		                    </td>
		                    <td>
		                      <div class="input-group ">
		                        <div class="input-group-prepend">
		                        </div>
		                        <input type="number" class="form-control onlynumber" id="rate" placeholder="Rate" aria-label="Rate" aria-describedby="" style="width:100px;" onkeyup="rateChange($(this));" name="price_per_unit[]" required>
		                      </div>                        
		                    </td>
		                    <td>
		                      <div class="input-group ">
		                        <div class="input-group-prepend">
		                          <span class="input-group-text" id="" style="height: 100%;"><i class="fa fa-balance-scale" aria-hidden="true"></i></span>
		                        </div>
		                        <input type="number" class="form-control onlynumber" id="qty" placeholder="Qty" aria-label="Qty" aria-describedby="" style="width:100px;"  onkeyup="qtyChange($(this));" name="quantity[]" required>
		                      </div>                        
		                    </td>
		                    <td>
		                      <div class="input-group ">
		                        <div class="input-group-prepend">
		                        </div>
		                        <input type="text" class="form-control amount" id="amount" placeholder="0.00" aria-label="0.00" aria-describedby=""  style="width:100px;" readonly="readonly" required>
		                      </div>                      
		                    </td>
		                    <td> 
		                      <button type="button" name="add" id="add" class="btn btn-danger" onClick="deleteProductRow($(this));" style="width:100%">X</button>
		                    </td> 
		    </tr>`;   
		    table_tbody.append(table_append);
	  	}

  	 	function allocateAll(this_target){
		    var value= this_target.find('option:selected').data('all');
		    var tr= this_target.parents('tr').get();
		    var mrp= $(tr).find('input#mrp');
		    var qty= $(tr).find('input#qty');
		    var rate= $(tr).find('input#rate');
		    var amount= $(tr).find('input#amount');
		    var per_unit= $(tr).find('#per_unit');
		    if(value){
        		value.unit_price= 0;
		      	mrp.val(parseFloat(value.price));
		      	qty.val('1');
	      		qty.prop('max',value.quantity);
		      	rate.val(value.price);
	      		amount.val(value.price);
	      		per_unit.html('Per '+ value.unit);
		    }else{
		      mrp.val('');
		      qty.val('');
		      rate.val('');
		      amount.val('');
		    }
		    showTotalAmount(); 
	  	}

	  	function deleteProductRow(this_target){
		    this_target.parents('tr').remove();
		    showTotalAmount();
	  	}

  	 	function qtyChange(this_target){
		    var qty_value= this_target.val();
		    var tr= this_target.parents('tr').get();
		    var mrp= $(tr).find('input#mrp').val();

		    if(!mrp){
		      return false;
		    }
		    if(qty_value){
		      if(qty_value== 0){
		        $(tr).find('input#amount').val('');
		      }else{
		        var rate= $(tr).find('input#rate').val();
		        var amount_row=  qty_value* rate;
		        var amount= $(tr).find('input#amount').val(amount_row.toFixed(2));
		      }
		    }else{
		      $(tr).find('input#amount').val('');
		    }
		    showTotalAmount();
	  	}

	  	function showTotalAmount(){
		     var table_tbody= $('table#main_table tbody');
		     var amounts=table_tbody.find('.amount');
		      var total_amount= 0;
		      $.each(amounts, function( key, value ) {
		        if($(value).val()){
		          total_amount+=  parseInt($(value).val());
		        }
		      });
		      $("#sub_total").val(total_amount);
		      add_vat_amount(total_amount);
		      amount_discount();
	  	}

	  	function amount_discount(){
		    var discount_amount= $("#discount").val();
		      var amount_percent= $('#amount_person_select');
		      if($(amount_percent).val()== "Percent"){
		        if($("#discount").val() >100){
		          $("#discount").val(0.00);
		          vat_amount= add_vat_amount($("#sub_total").val());
		          $("#total").val(parseFloat($("#sub_total").val())+ parseFloat(vat_amount));
		          // $("#total").val($("#sub_total").val());
		          alert('DISCOUNT PERCENT MORE THAN 100%');
		          return false;
		        }
		        var total_with_vat= parseFloat($("#sub_total").val())+ parseFloat(add_vat_amount($("#sub_total").val()));
		        var total_amount= total_with_vat- ((total_with_vat*discount_amount)/100);
		        // debugger;
		      }else if($(amount_percent).val()== "Amount"){
		      	var total_with_vat= parseFloat($("#sub_total").val())+ parseFloat(add_vat_amount($("#sub_total").val()));
		        var total_amount= total_with_vat- discount_amount;
		        // debugger;
		      }
		      if(total_amount<0){
		        $("#discount").val(0.00);
		        vat_amount= add_vat_amount($("#sub_total").val());
	          	$("#total").val(parseFloat($("#sub_total").val())+ parseFloat(vat_amount));
		        // $("#total").val($("#sub_total").val());
		        alert('DISCOUNT AMOUNT LARGER THAN ACTUAL AMOUNT');
		        return false;
		      }
		      // vat_amount= add_vat_amount(total_amount);
	       		//    $("#total").val(total_amount+ vat_amount);
		      $("#total").val(total_amount);
	  	}

	  	function amount_percent(amount_percent){
		    if($(amount_percent).val()== "Percent"){
		      $('#discount_div> #for_amount').html('%');
		    }else if($(amount_percent).val()== "Amount"){
		    }
		    amount_discount();
	  	}

	  	function rateChange(this_target){
		    var tr= this_target.parents('tr').get();
		    qtyChange($(tr).find('#qty'));
	  	}

	  	function vat_added(this_target){
	  		showTotalAmount();
	  		// $("#vat_amount").val(total_amount);
	  	}

	  	function add_vat_amount(sub_total){
	  		var vat_amount= sub_total*$("#vat_percent").val()/100;
	  		$("#vat_amount").val(vat_amount);
	  		return vat_amount;
	  	}
	</script>
@endsection
