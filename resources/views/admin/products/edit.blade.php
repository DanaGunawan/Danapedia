@extends('admin/layouts/app')
<!-- Content Wrapper. Contains page content -->

@section('content')

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<div class="card">
  <form action="" method="post">
    @csrf
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="title">Title <span style="color:red;">*</span></label>
            @if($errors->has('title'))
        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
      @endif
            <input type="text" class="form-control" id="title" name="title"
              value="{{ old('title', $singleProduct->title) }}" placeholder="Enter title">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="sku">SKU <span style="color:red;">*</span></label>
            @if($errors->has('sku'))
        <div class="alert alert-danger">{{ $errors->first('sku') }}</div>
      @endif
            <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku', $singleProduct->sku) }}"
              placeholder="Enter sku">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="category_id">Category Name <span style="color:red;">*</span></label>
            @if($errors->has('category_id'))
        <div class="alert alert-danger">{{ $errors->first('category_id') }}</div>
      @endif
            <select name="category_id" class="form-control" id="category_id">
              <option value="">--Select Category--</option>
              @foreach ($categoryList as $list)
          <option {{ ($singleProduct->category_id == $list->id) ? 'selected' : ''}} value="{{ $list->id }}">
          {{ $list->name }}</option>
        @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="subCategory_id">Sub Category Name <span style="color:red;">*</span></label>
            @if($errors->has('subCategory_id'))
        <div class="alert alert-danger">{{ $errors->first('subCategory_id') }}</div>
      @endif
            <select name="subCategory_id" class="form-control" id="subCategory_id">
              <option value="">-- Select Sub Category --</option>
              @foreach ($subCategory as $list)
          <option {{ ($singleProduct->sub_category_id == $list->id) ? 'selected' : '' }} value="{{ $list->id }}">
          {{ $list->name }}</option>
        @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="brand_id">Brand Name <span style="color:red;">*</span></label>
            @if($errors->has('brand_id'))
        <div class="alert alert-danger">{{ $errors->first('brand_id') }}</div>
      @endif
            <select name="brand_id" class="form-control" id="brand_id">
              <option value="">--Select Brand--</option>
              @foreach ($brandList as $list)
          <option {{ ($singleProduct->brand_id == $list->id) ? 'selected' : ''}} value="{{ $list->id }}">
          {{ $list->name }}</option>
        @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status">
              <option {{ $singleProduct->status == 'Active' ? 'selected' : '' }} value="Active">Active</option>
              <option {{ $singleProduct->status == 'Inactive' ? 'selected' : '' }} value="Inactive">Inactive</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="color">Color List Product <span style="color:red;">*</span></label>
            <div class="row">
              @foreach($colorList as $color)
                @php
            $check = '';
        @endphp
                @foreach($singleProduct->getColor as $checkColor)
            @if($checkColor->color_id == $color->id)
          @php
        $check = 'checked';
      @endphp
      @endif
        @endforeach
                <div class="col-md-3">
                <label><input {{ $check }} type="checkbox" name="color_id[]" value="{{ $color->id }}"> {{  $color->name}} </label>
                </div>
        @endforeach
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <hr>
          <div class="form-group">
            <label for="size">Size List</label>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Size</th>
                  <th>Quantity</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="appendSize">
                <tr>
                  <td><input class="form-control" type="text" name="size[]" id="size" placeholder="size"></td>
                  <td><input class="form-control" type="text" name="quantity[]" id="quantity" placeholder="quantity">
                  </td>
                  <td style="width:100px;">
                    <a class="btn btn-primary" id="sizeAdd"> Add </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="col-md-12">
          <hr>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="price">Price <span style="color:red;">*</span></label>
            @if($errors->has('price'))
        <div class="alert alert-danger">{{ $errors->first('price') }}</div>
      @endif
            <input type="number" class="form-control" id="price" name="price"
              value="{{ old('price', $singleProduct->price) }}" placeholder="Enter Price">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="old_price">Old Price <span style="color:red;">*</span></label>
            @if($errors->has('old_price'))
        <div class="alert alert-danger">{{ $errors->first('old_price') }}</div>
      @endif
            <input type="number" class="form-control" id="old_price" name="old_price"
              value="{{ old('old_price', $singleProduct->old_price) }}" placeholder="Enter Old Price">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="short_description">Short Description <span style="color:red;">*</span></label>
            @if($errors->has('short_description'))
        <div class="alert alert-danger">{{ $errors->first('short_description') }}</div>
      @endif
            <textarea class="form-control" name="short_description" id="short_description"
              placeholder="Short description">{{ old('short_description', $singleProduct->short_description) }}</textarea>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="Description">Description <span style="color:red;">*</span></label>
            @if($errors->has('Description'))
        <div class="alert alert-danger">{{ $errors->first('Description') }}</div>
      @endif
            <textarea class="form-control editor" name="Description" id="Description"
              placeholder="Description">{{ old('Description', $singleProduct->description) }}</textarea>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="additional_information">Additional Information <span style="color:red;">*</span></label>
            @if($errors->has('additional_information'))
        <div class="alert alert-danger">{{ $errors->first('additional_information') }}</div>
      @endif
            <textarea class="form-control editor" name="additional_information" id="additional_information"
              placeholder="Additional information">{{ old('additional_information', $singleProduct->additional_information) }}</textarea>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="shipping_return">Shipping & Return <span style="color:red;">*</span></label>
            @if($errors->has('shipping_return'))
        <div class="alert alert-danger">{{ $errors->first('shipping_return') }}</div>
      @endif
            <textarea class="form-control editor" name="shipping_return" id="shipping_return"
              placeholder="Shipping & Return">{{ old('shipping_return', $singleProduct->shipping_return) }}</textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
      <a class="btn btn-danger" href="{{ url('product') }}">Back</a>
    </div>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    $('#category_id').change(function () {
      var categoryID = $(this).val();
      if (categoryID) {
        $.ajax({
          url: '/getSubCategory/' + categoryID,
          type: 'GET',
          dataType: 'json',
          success: function (data) {
            $('#subCategory_id').empty();
            $('#subCategory_id').append('<option value="">-- Select Sub Category --</option>');
            $.each(data, function (key, value) {
              $('#subCategory_id').append('<option value="' + key + '">' + value + '</option>');
            });
          }
        });
      } else {
        $('#subCategory_id').empty();
      }
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
  $(document).ready(function () {
    $('.editor').summernote();
  });
</script>

<script>
  $(document).ready(function () {
    $('#sizeAdd').click(function () {
      var sizeRow = '<tr><td><input class="form-control" type="text" name="size[]" placeholder="size"></td><td><input class="form-control" type="text" name="quantity[]" placeholder="quantity"></td><td><a class="btn btn-danger sizeRemove"> Remove </a></td></tr>';
      $('.appendSize').append(sizeRow);
    });

    $(document).on('click', '.sizeRemove', function () {
      $(this).closest('tr').remove();
    });
  });
</script>

@endsection