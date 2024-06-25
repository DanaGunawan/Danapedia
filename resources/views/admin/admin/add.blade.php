@extends('admin/layouts/app')
  <!-- Content Wrapper. Contains page content -->

  @section('content')

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Admin</h1>
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
                    @if($errors->has('name'))
                    <div class="alert alert-danger"> {{ $errors->first('name') }}</div>
                    @endif
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    @if($errors->has('email'))
                      <div class="alert alert-danger"> {{ $errors->first('email') }}</div>
                      @endif
                    <input type="email" class="form-control" id="email" value="{{old('email')}}" name="email" placeholder="Enter Email">
                  </div> 
                <div class="form-group">
                  <label for="password">Password</label>
                  @if($errors->has('password'))
                      <div class="alert alert-danger"> {{ $errors->first('password') }}</div>
                      @endif
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                  </div>

                  <div class="form-group">
                    <label for="phone">phone</label>
                    @if($errors->has('phone'))
                      <div class="alert alert-danger"> {{ $errors->first('phone') }}</div>
                      @endif
                    <input type="number" class="form-control" id="phone" value="{{old('phone')}}" name="phone" placeholder="Enter phone number">
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