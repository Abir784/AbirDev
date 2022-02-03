@extends('layouts.dashboard')
@section('content')
<div class="container-fluid border bordered-danger">
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header text-center">
                  <strong class="text-center"> Complete your Profile</strong>
                </div>
                <div class="card-body">
                    <div class="mb-3">

                    @if (session('session'))

                    <strong class="alert alert-danger">{{session('session')}}</strong>
                    @endif

                    </div>


                    <form action="{{url('profile/change')}}" method="POST" enctype="multipart/form-data">
                 @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">User Name</label>
                <input name="name" type="text" class="form-control" value="{{Auth::user()->name}}">
              </div>
              @error('name')
                  <strong class="text-danger">{{$message}}</strong>
              @enderror

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Change profile Photo</label>
                <input name="profile_image" type="file" class="form-control" >
              </div>

              @error('profile_image')
                  <strong class="text-danger">{{$message}}</strong>
              @enderror

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"> Enter Password</label>
                <input name="old_password" type="password" class="form-control" >
              </div>

              @error('old_password')
                  <strong class="text-danger">{{$message}}</strong>
              @enderror

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Enter New Password(if you to change old one)</label>
                <input name="password" type="password" class="form-control" >
              </div>

              @error('password')
                  <strong class="text-danger">{{$message}}</strong>
              @enderror
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Confirm Password</label>
                <input name="password_confirmation" type="password" class="form-control" >
              </div>

              @error('password_confirmation')
                  <strong class="text-danger">{{$message}}</strong>
              @enderror
              <div class="mb-3">

              <button type="sumbit" class="btn btn-primary"> Submit</button>

              </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
