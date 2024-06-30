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
        <a href="/admin/category/add" class="btn btn-primary" style="align"> Add New Category </a>
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
        <h3 class="card-title">Category List</h3>


      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th>category_id</th>
              <th>category_name</th>
              <th>meta_title</th>
              <th>Slug</th>     
              <th>Created By</th>  
              <th>Created At</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($category as $value)

        <tr>
          <td>{{$value['id']}}</td>
          <td>{{$value['name']}}</td>
          <td>{{$value['meta_title']}}</td>
          <td>{{$value['slug']}}</td>
          <td>{{$value['created_by']}}</td>
          <td>{{date('d-m-Y',strtotime($value['created_at']))}}</td>


          <td>
          <span
            class="{{ $value['status'] == 'Active' ? 'bg-success' : 'bg-danger' }} text-white rounded-pill p-1 text-center"
            style="display: inline-block; min-width: 80px;">
            {{ $value['status'] }}
          </span>
          </td>
          <td> 
          <a href="/admin/category/edit/{{$value["id"]}}" class="btn btn-primary" style="align"> Edit </a>
          <a href="/admin/category/delete/{{$value["id"]}}" class="btn btn-danger" id="delete" onclick="return confirmDelete()">Delete</a>

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