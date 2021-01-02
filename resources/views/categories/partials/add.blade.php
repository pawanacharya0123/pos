<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Create new Category</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form action="{{route('categories.store')}}" method="POST">
      @csrf
      <div class="form-group">
        <label for="recipient-name" class="col-form-label">Category name:</label>
        <input type="text" class="form-control {{$errors->has('name')?'is-invalid':''}}" id="recipient-name" name="name" value="{{old('name')}}">
        @if ($errors->has('name'))
          <div class="invalid-feedback">
            {{$errors->first('name')}}
          </div>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </form>
  </div>
</div>