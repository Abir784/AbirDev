@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">

            <table class="table table-bordered">
                @if (session('deleted'))
                <div class="alert alert-danger">{{session('deleted')}}</div>

            @endif
            <tr><th colspan="5" class="m-auto">Sub Category Info</th></tr>


                <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Sub Category Name</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                <tr>
                @forelse ($subcategory as $key=>$item)
                <td>{{$key+1}}</td>
                <td>{!!($item->rel_to_category->deleted_at == NULL)?$item->rel_to_category->catagory_name:'<del>' .$item->rel_to_category->catagory_name .'</del>' !!}</td>
                <td>{{$item->subcategory_name}}</td>
                <td>{{$item->created_at->diffforhumans()}}</td>
                <td><a href="{{route('subcategory.delete',$item->id)}}" class="btn btn-danger">Trash</a></td>
                <td><a href="{{route('subcategory.edit',$item->id)}}" class="btn btn-secondary">Edit</a></td>



            </tr>

                @empty
                <td colspan="5" class="m-auto">No data found</td>

                @endforelse
           </table>
        </div>


        <div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h3>Add Sub Category</h3>
        </div>
        <div class="card-body">
            @if (session('sub_added'))
                <div class="alert alert-success">{{session('sub_added')}}</div>

            @endif
            @error('subcategory_name')
            <strong class='text-danger'>{{$message}}</strong>
          @enderror

        <form action="{{url('/subcategory/insert')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <select class="form-control" name="category_id" id="">
                    <option value="">--Select Catagory Name--</option>
                    @foreach ($category as $cat )
                      <option name='category_id' value='{{$cat->id}}'>{{$cat->catagory_name}}</option>

                    @endforeach


                </select>
              </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Sub Category Name</label>
                <input name="subcategory_name" type="text" class="form-control" >
              </div>
              <button type="sumbit" class="btn btn-primary"> Submit</button>

        </form>

        </div>
    </div>
</div>
</div>
</div>
@endsection
