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
        <a href="/admin/brands/add" class="btn btn-primary" style="align"> Add New Brand </a>
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
        <h3 class="card-title">Brand List</h3>


      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th>Brand_id</th>
              <th>Brand_name</th>
              <th>Slug</th>     
              <th>Created By</th>  
              <th>Created At</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
                        @foreach ( $brands as $brand)

                        <td> {{ $brand->id }}</td>
                        <td> {{ $brand->name }}</td>
                        <td> {{ $brand->slug }}</td>
                        <td> {{ $brand->created_by }}</td>
                        <td>{{date('d-m-Y',strtotime($brand['created_at']))}}</td>
                        <td>
          <span
            class="{{ $brand['status'] == 'Active' ? 'bg-success' : 'bg-danger' }} text-white rounded-pill p-1 text-center"
            style="display: inline-block; min-width: 80px;">
            {{ $brand['status'] }}
          </span>
          </td>
          <td> 
          <a href="/admin/brands/edit/{{$brand["id"]}}" class="btn btn-primary" style="align"> Edit </a>
          <a href="/admin/brands/delete/{{$brand["id"]}}" class="btn btn-danger" id="delete" onclick="return confirmDelete()">Delete</a>

          </td>
                        @endforeach
          </tbody>
        </table>
        <div style="padding:10px; float:right;">
          {!! $brands->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} 
        </div>
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