@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Welcome,<strong style="color:tomato ">  {{Auth::User()->name}}</strong> !<span class="float-end"> Total users:{{$num_user}}</span></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                      <table class="table table-bordered">
                          <tr>
                              <th>SL</th>
                              <th>DP</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Created At</th>
                              <th>Action</th>
                          </tr>
                          @foreach ($users as $key=>$user)
                          <tr>
                              <td>{{$users->firstitem()+$key}}</td>
                              <td><img class="rounded-circle" width="75px" src="{{asset('/uploads/profile_image/'.$user->profile_image)}}" alt=""></td>
                              <td>{{$user->name}}</td>
                              <td>{{$user->email}}</td>
                              <td>{{$user->created_at}}</td>
                              <td><a href="{{route('del',$user->id)}}" Class="btn btn-danger">Delete</a></td>
                          </tr>
                          @endforeach
                      </table>
                      {{ $users->links() }}
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
