@extends('admin/layouts/app')
<!-- Content Wrapper. Contains page content -->

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{ $header_title }}</h1>
      </div>
      <div class="col-sm-6" style="text-align: right;">
        <a href="/admin/colors/add" class="btn btn-primary" style="align"> Add New color </a>
      </div>
    </div>
  </div>
</section>

@include('admin/layouts/_message')
<!-- Main content -->

<section class="content">
  <div class="container-fluid">
    <!-- /.card -->
  </div>
  <!-- /.col -->
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">color List</h3>


      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th>color_id</th>
              <th>color_name</th>
              <th>code</th>     
              <th>Created By</th>  
              <th>Created At</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
                        @foreach ( $colors as $color)

                        @extends('admin/layouts/app')
<!-- Content Wrapper. Contains page content -->

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{ $header_title }}</h1>
      </div>
      <div class="col-sm-6" style="text-align: right;">
        <a href="/admin/colors/add" class="btn btn-primary" style="align"> Add New color </a>
      </div>
    </div>
  </div>
</section>

@include('admin/layouts/_message')
<!-- Main content -->

<section class="content">
  <div class="container-fluid">
    <!-- /.card -->
  </div>
  <!-- /.col -->
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">color List</h3>


      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th>color_id</th>
              <th>color_name</th>
              <th>code</th>     
              <th>Created By</th>  
              <th>Created At</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
                        @foreach ( $colors as $color)
<tr>
                        <td> {{ $color->id }}</td>
                        <td> {{ $color->name }}</td>
                        <td> {{ $color->code }}</td>
                        <td> {{ $color->created_by }}</td>
                        <td>{{date('d-m-Y',strtotime($color['created_at']))}}</td>
                        <td>
          <span
            class="{{ $color['status'] == 'Active' ? 'bg-success' : 'bg-danger' }} text-white rounded-pill p-1 text-center"
            style="display: inline-block; min-width: 80px;">
            {{ $color['status'] }}
          </span>
          </td>
          <td> 
          <a href="/admin/colors/edit/{{$color["id"]}}" class="btn btn-primary" style="align"> Edit </a>
          <a href="/admin/colors/delete/{{$color["id"]}}" class="btn btn-danger" id="delete" onclick="return confirmDelete()">Delete</a>

          </td>
          </tr>
                        @endforeach
                

          </tbody>
        </table>
      </div>
    </div>
  </div>


</section>

<script>
function confirmDelete() {
    return confirm('Apakah anda yakin ingin menghapus?');
}
</script>

@endsection
                        @endforeach
                

          </tbody>
        </table>
      </div>
    </div>
  </div>


</section>

<script>
function confirmDelete() {
    return confirm('Apakah anda yakin ingin menghapus?');
}
</script>

@endsection