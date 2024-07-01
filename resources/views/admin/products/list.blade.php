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
        <a href="/admin/products/add" class="btn btn-primary" style="align"> Add New Products </a>
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
        <h3 class="card-title">Products List</h3>


      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th>id</th>
              <th>title</th>
              <th>category</th>
              <th>sub category</th>  
              <th>size </th>   
              <th>color</th>
              <th>brand </th>  
              <th>price</th>
              <th>Shipping&returns</th>
              <th>Image</th>
              <th>Created At</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

          

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