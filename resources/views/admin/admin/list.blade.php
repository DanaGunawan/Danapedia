@extends('admin/layouts/app')
<!-- Content Wrapper. Contains page content -->

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Admin List</h1>
      </div>
      <div class="col-sm-6" style="text-align: right;">
        <a href="/admin/admin/add" class="btn btn-primary" style="align"> Add New Admin </a>
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
        <h3 class="card-title">Admin List</h3>


      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th>id</th>
              <th>Username</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($dataAdmin as $value)

        <tr>
          <td>{{$value['id']}}</td>
          <td>{{$value['name']}}</td>
          <td>{{$value['email']}}</td>
          <td>{{$value['phone']}}</td>
          <td>
          <span
            class="{{ $value['status'] == 'Active' ? 'bg-success' : 'bg-danger' }} text-white rounded-pill p-1 text-center"
            style="display: inline-block; min-width: 80px;">
            {{ $value['status'] }}
          </span>
          </td>
          <td>        <a href="/admin/admin/edit/{{$value["id"]}}" class="btn btn-primary" style="align"> Edit </a>
                      <a href="/admin/admin/delete/{{$value["id"]}}" class="btn btn-danger" style="align"> Delete</a>

          </td>
        </tr>
      @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>


</section>




@endsection