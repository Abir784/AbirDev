@extends('layouts.dashboard');
@section('content')
<div class="container-fluid">

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Update Sub Category</h3>
            </div>
            <div class="card-body">
                @if (session('updated'))
                <div class="alert alert-success">{{session('updated')}}</div>

                @endif
                @error('subcatagory_name')
                <strong class='text-danger'>{{$message}}</strong>
                @enderror

                <form action="{{url('/subcategory/update')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$sub_info->id}}">

                    <div class="mb-3">
                        <select class="form-control" name="category_id" id="">

                            <option name="category_id" value="{{$sub_info->category_id}}">{{$sub_info->rel_to_category->catagory_name}}</option>

                            @foreach ($cat_info as $loopp )

                            <option name="category_id" value="{{$loopp->id}}">{{$loopp->catagory_name}}</option>

                            @endforeach

                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Sub Category Name</label>
                        <input  value="{{$sub_info->subcategory_name}}"
                        name="subcategory_name" type="text" class="form-control" >
                    </div>

                    <button type="sumbit" class="btn btn-primary"> Update</button>

                </form>

            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection
