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
        <label for="title">title <span style="color:red;">*</span></label>
        @if($errors->has('title'))
      <div class="alert alert-danger"> {{ $errors->first('title') }}</div>
    @endif
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title')}}" placeholder="Enter title">
      </div>
      

      <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" name="status">
          <option {{(old('status') == 'Active') ? 'selected' : ''}} value="Active">Active</option>
          <option {{(old('status') == 'Inactive') ? 'selected' : ''}} value="Inactive">Inactive</option>
        </select>
      </div>


    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>


@endsection