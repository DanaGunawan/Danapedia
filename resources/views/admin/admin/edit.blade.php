@extends('admin/layouts/app')
  <!-- Content Wrapper. Contains page content -->

  @section('content')

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Admin</h1>
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
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{$singleAdmin['name']}}" id="name" name="name" placeholder="Enter Name" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" value="{{$singleAdmin['email']}}" name="email" placeholder="Enter Email" required>
                  </div> 
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password"  id="password" placeholder="Enter Password">
                    <p>input password jika ingin mengganti!</p>
                  </div>

                  <div class="form-group">
                    <label for="phone">phone</label>
                    <input type="number" class="form-control" id="phone" value="{{$singleAdmin['phone']}}" name="phone" placeholder="Enter phone number" required>
                  </div>

                  <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status">
                    <option {{($singleAdmin->status == 'Active') ? 'selected' : ''}}value="Active">Active</option>
                    <option {{($singleAdmin->status == 'Inactive') ? 'selected' : ''}} value="Inactive">Inactive</option>
                    </select>
                </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>


@endsection