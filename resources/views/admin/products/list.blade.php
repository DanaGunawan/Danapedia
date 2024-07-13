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
              <th>price</th>
              <th>Image</th>
              <th>Created By</th>
              <th>Created At</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ( $products as $product)
            <tr>
              <td>{{ $product->id }}</td>
              <td>{{ $product->title }}</td>
              <td>{{ $product->price }}</td>
              <td><img src="{{ asset('storage/'.$product->image) }}" width="100px
              "></td>
              <td>{{ $product->created_by }}</td>
              <td>{{ $product->created_at }}</td>
              <td>
          <span
            class="{{ $product['status'] == 'Active' ? 'bg-success' : 'bg-danger' }} text-white rounded-pill p-1 text-center"
            style="display: inline-block; min-width: 80px;">
            {{ $product['status'] }}
          </span>
          </td>
          <td> 
          <a href="/admin/products/edit/{{$product["id"]}}" class="btn btn-primary" style="align"> Edit </a>
          <a href="/admin/products/delete/{{$product["id"]}}" class="btn btn-danger" id="delete" onclick="return confirmDelete()">Delete</a>

          </td>
            </tr>

            
            @endforeach
          </tbody>
        </table>

        <div style="padding:10px; float:right;">
          {!! $products->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} 
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