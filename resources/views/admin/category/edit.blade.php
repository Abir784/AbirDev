@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Edit  Category</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>

                @endif
                @error('catagory_name')
                <strong class='text-danger'>{{$message}}</strong>
                @enderror

                <form action="{{url('/category/update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="id" value="{{$edit_info->id}}">
                        <label for="exampleInputEmail1" class="form-label">Category Name</label>
                        <input  value="{{$edit_info->catagory_name}}"
                        name="catagory_name" type="text" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Category Image</label>
                        <input name="category_image" type="file" class="form-control" >
                    </div>

                    <button type="sumbit" class="btn btn-primary"> Submit</button>

                </form>

            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection
