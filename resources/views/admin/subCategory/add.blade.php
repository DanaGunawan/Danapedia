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
        <label for="category_id">Category Name <span style="color:red;">*</span></label>
        @if($errors->has('category_id'))
      <div class="alert alert-danger"> {{ $errors->first('category_id') }}</div>
    @endif
    <select name="category_id" class="form-control" id="" aria-placeholder="">
            <option value="">--Select Category--</option>
            @foreach ($categoryList as $list )
            <option value="{{ $list->id}}"> {{ $list->name }}</option>
            @endforeach
            </select>
</div>

      <div class="form-group">
        <label for="name">Sub Category <span style="color:red;">*</span></label>
        @if($errors->has('name'))
      <div class="alert alert-danger"> {{ $errors->first('name') }}</div>
    @endif
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}" placeholder="Enter name">
      </div>
      <div class="form-group">
        <label for="name">Slug <span style="color:red;">*</span> </label>
        @if($errors->has('slug'))
      <div class="alert alert-danger"> {{ $errors->first('slug') }}</div>
    @endif
        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug')}}" placeholder="Enter slug">
      </div>

      <div class="form-group">
        <label for="name">meta_title <span style="color:red;">*</span></label>
        @if($errors->has('meta_title'))
      <div class="alert alert-danger"> {{ $errors->first('meta_title') }}</div>
    @endif
        <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title')}}"
          placeholder="Enter meta title">
      </div>

      <div class="form-group">
        <label for="meta_description">meta_description <span style="color:red;">*</span> </label>
        @if($errors->has('meta_description'))
      <div class="alert alert-danger"> {{ $errors->first('meta_description') }}</div>
    @endif
        <textarea class="form-control" id="meta_description" name="meta_description"
          placeholder="Enter Meta Description">{{ old('meta_description') }}</textarea>
      </div>


      <div class="form-group">
        <label for="name">meta_keywords</label>
        @if($errors->has('meta_keywords'))
      <div class="alert alert-danger"> {{ $errors->first('meta_keywords') }}</div>
    @endif
        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
          value="{{ old('meta_keywords')}}" placeholder="Enter meta title">
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