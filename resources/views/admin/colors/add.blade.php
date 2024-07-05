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
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}" placeholder="Enter name">
      </div>

      <div class="form-group">
        <label for="name">code <span style="color:red;">*</span> </label>
        @if($errors->has('code'))
      <div class="alert alert-danger"> {{ $errors->first('code') }}</div>
    @endif
        <input type="color" class="form-control" id="code" name="code" value="{{ old('code')}}" placeholder="Enter slug">
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