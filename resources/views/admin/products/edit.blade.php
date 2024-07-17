@extends('admin/layouts/app')
<!-- Content Wrapper. Contains page content -->

@section('content')

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@include('admin/layouts/_message')

<div class="card">
  <form action="" method="post" enctype="multipart/form-data">
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
          {{ $list->name }}
          </option>
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
          {{ $list->name }}
          </option>
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
          {{ $list->name }}
          </option>
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
                <label><input {{ $check }} type="checkbox" name="color_id[]" value="{{ $color->id }}">
                  {{  $color->name}} </label>
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

              @php
        $i_s = 1;
        @endphp
              <tbody class="appendSize">
                @foreach ($singleProduct->getSize as $size)
                  <tr id="DeleteSize{{ $i_s }}">
                    <td><input class="form-control" type="text" name="size[{{ $i_s }}][size]" value='{{ $size->size }}'
                      placeholder="size"></td>
                    <td><input class="form-control" type="text" name="size[{{ $i_s }}][quantity]"
                      value='{{ $size->quantity }}' placeholder="quantity"></td>
                    <td>
                    <a href="javascript:void(0);" id="{{ $i_s }}" class="btn btn-danger sizeRemove"> Remove </a>
                    </td>
                  </tr>
                  @php
          $i_s++;
          @endphp
        @endforeach
                <tr>
                  <td><input class="form-control" type="text" name="size[{{ $i_s }}][size]" placeholder="size"></td>
                  <td><input class="form-control" type="text" name="size[{{ $i_s }}][quantity]" placeholder="quantity">
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
          <div class="form-group">
            <label for="image">Post Image <span style="color:red;">*</span></label>
            @if($errors->has('image'))
        <div class="alert alert-danger">{{ $errors->first('image') }}</div>
      @endif
            <input type="file" id="image" name="image[]" class="form-control" style="padding:5px;" multiple
              accept="image/*">
          </div>
        </div>

        @if(!empty($singleProduct->getImage->count()))
      <div class="col-md-12">
        <div class="row" id="sortable">
        @foreach ($singleProduct->getImage as $image)
      @if(!empty($image->imageUrl()))
      <div class="col-md-2 sortable_image" id="{{ $image->id }}" style="text-align:center;">
      <img src="{{ $image->imageUrl() }}" style="width:100%; height:200px;">
      <a href="/admin/products/delete_image/{{ $image->id }}" style="margin-top:10px;"
      class="btn btn-danger btn-sm" onclick="return confirmDelete()"> delete </a>
      </div>
    @endif
    @endforeach
        </div>
      </div>
    @endif


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

    $('#category_id').change(function (e) {
      var id = $(this).val();
      $.ajax({
        type: "post",
        url: "{{ url('admin/getSubCategory') }}",
        data: {
          id: id,
          _token: '{{ csrf_token() }}'
        },
        dataType: "json",
        success: function (data) {
          $('#subCategory_id').html(data.options);
        },
        error: function (xhr, status, error) {
          console.log('Error:', xhr.responseText);
        }
      });
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

<script>
  $(document).ready(function () {
    $('.editor').summernote();


  });


</script>

<script>
  let i = 1;
  $(document).ready(function () {
    $('#sizeAdd').click(function () {
      var sizeRow =
        '<tr id="sizeRemove' + i + '">\n\
      <td><input class="form-control" type="text" name="size['+ i + '][size]" placeholder="size"></td>\n\
      <td><input class="form-control" type="text" name="size['+ i + '][quantity]" placeholder="quantity"></td>\n\
      <td><a id="'+ i + '" class="btn btn-danger sizeRemove"> Remove </a></td>\n\
      </tr>';
      $('.appendSize').append(sizeRow);
      i++;
    });

    $(document).on('click', '.sizeRemove', function () {
      $(this).closest('tr').remove();
    });
  });
</script>

<script>
  function confirmDelete() {
    return confirm('Apakah anda yakin ingin menghapus Gambar?');
  }

    $("#sortable").sortable({
        update: function(event, ui) {
            var photo_id = [];
            $('.sortable_image').each(function() {
                var id = $(this).attr('id');
                photo_id.push(id);
            
            });

            $.ajax({
                type: "post",
                url: "{{ url('admin/products_image_sortable') }}",
                data: {
                    'photo_id': photo_id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(data) {
                    $('#subCategory_id').html(data.options);
                },
                error: function(xhr, status, error) {
                    console.log('Error:', xhr.responseText);
                }
            });
        }
    });

</script>

@endsection