@extends('admin.layouts.app')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{ $header_title }}</h1>
      </div>
      <div class="col-sm-6" style="text-align: right;">
      </div>
    </div>
  </div>
</section>

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
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Enter title">
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
                <option value="{{ $list->id }}">{{ $list->name }}</option>
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
              <option value="">--Select Sub Category--</option>
              @foreach ($categoryList as $list)
                <option value="{{ $list->id }}">{{ $list->name }}</option>
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
              @foreach ($categoryList as $list)
                <option value="{{ $list->id }}">{{ $list->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status">
              <option {{ old('status') == 'Active' ? 'selected' : '' }} value="Active">Active</option>
              <option {{ old('status') == 'Inactive' ? 'selected' : '' }} value="Inactive">Inactive</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="color">Color List Product <span style="color:red;">*</span></label>
            <div class="row">
              <div class="col-md-3">
                <label><input type="checkbox" name="color_id[]" value="Red"> Red</label>
              </div>
              <div class="col-md-3">
                <label><input type="checkbox" name="color_id[]" value="Green"> Green</label>
              </div>
              <div class="col-md-3">
                <label><input type="checkbox" name="color_id[]" value="Blue"> Blue</label>
              </div>
              <div class="col-md-3">
                <label><input type="checkbox" name="color_id[]" value="Yellow"> Yellow</label>
              </div>
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
              <tbody>
                <tr>
                  <td><input class="form-control" type="text" name="size[]" id="size" placeholder="size"></td>
                  <td><input class="form-control" type="text" name="quantity[]" id="quantity" placeholder="quantity"></td>
                  <td> 
                    <a href="javascript:void(0);" class="btn btn-primary" id="add"> Add </a>
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
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="Enter Price">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="old_price">Old Price <span style="color:red;">*</span></label>
            @if($errors->has('old_price'))
              <div class="alert alert-danger">{{ $errors->first('old_price') }}</div>
            @endif
            <input type="number" class="form-control" id="old_price" name="old_price" value="{{ old('old_price') }}" placeholder="Enter Old Price">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="short_description">Short Description <span style="color:red;">*</span></label>
            @if($errors->has('short_description'))
              <div class="alert alert-danger">{{ $errors->first('short_description') }}</div>
            @endif
            <textarea class="form-control" name="short_description" id="short_description" placeholder="Short description">{{ old('short_description') }}</textarea>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="Description">Description <span style="color:red;">*</span></label>
            @if($errors->has('Description'))
              <div class="alert alert-danger">{{ $errors->first('Description') }}</div>
            @endif
            <textarea class="form-control" name="Description" id="Description" placeholder="Description">{{ old('Description') }}</textarea>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="additional_information">Additional Information <span style="color:red;">*</span></label>
            @if($errors->has('additional_information'))
              <div class="alert alert-danger">{{ $errors->first('additional_information') }}</div>
            @endif
            <textarea class="form-control" name="additional_information" id="additional_information" placeholder="Additional information">{{ old('additional_information') }}</textarea>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="shipping_return">Shipping & Return <span style="color:red;">*</span></label>
            @if($errors->has('shipping_return'))
              <div class="alert alert-danger">{{ $errors->first('shipping_return') }}</div>
            @endif
            <textarea class="form-control" name="shipping_return" id="shipping_return" placeholder="Shipping & Return">{{ old('shipping_return') }}</textarea>
          </div>
        </div>
      </div>
    </div>



    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>

@endsection
