@extends('admin/layouts/app')
<!-- Content Wrapper. Contains page content -->

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
      <div class="form-group">
        <label for="name">Name <span style="color:red;">*</span></label>
        @if($errors->has('name'))
      <div class="alert alert-danger"> {{ $errors->first('name') }}</div>
    @endif
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $getSingleProduct)}}"
          placeholder="Enter name">
      </div>

      <div class="form-group">
        <label for="price">price <span style="color:red;">*</span></label>
        @if($errors->has('price'))
      <div class="alert alert-danger"> {{ $errors->first('price') }}</div>
    @endif
        <input type="number" class="form-control" id="price" name="price" value="{{ old('price' ,$getSingleProduct['price'])}}"
          placeholder="Enter name">
      </div>

      <div class="form-group">
        <label for="image">image <span style="color:red;">*</span></label>
        @if($errors->has('image'))
      <div class="alert alert-danger"> {{ $errors->first('image') }}</div>
    @endif
        <input type="number" class="form-control" id="image" name="image" value="{{ old('image' ,$getSingleProduct)}}"
          placeholder="Enter name">
      </div>
     



    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>


@endsection