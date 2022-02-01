@extends('layouts.dashboard')
 @section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">

            <table class="table table-bordered">
                @if (session('deleted'))
                <div class="alert alert-primary">{{session('deleted')}}</div>

            @endif
            <tr><th colspan="5" class="m-auto">Category Info</th></tr>
            <form action="category/markdel" method="post">
                @csrf
                <tr>
                    <th><input type="checkbox" id="checkAll"> Check All</th>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Added By</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>

                @forelse ($cat as $key=>$item )

                <tr>
                    <td> <input type="checkbox" name="mark[]" id="checkbox" value={{$item->id}}></td>
                    <td>{{$key+1}}</td>
                    <td>{{$item->catagory_name}}</td>
                    <td>{{App\Models\User::find($item->added_by)->name}}</td>
                    <td><img width="100px" src="{{asset('uploads/category')}}/{{$item->category_image}}" alt=""></td>
                    <td>{{$item->created_at->diffforHumans()}}</td>




                    <td><a href="{{route('delete', $item->id )}}" Class="btn btn-danger mb-3">Delete</a>
                        <a href="{{route('edit', $item->id )}}" Class="btn btn-warning">Edit</a></td>
                </tr>

                @empty
                    <td colspan="5" class="m-auto">No data found</td>

                @endforelse
                <button type="submit" class="btn btn-danger">Deleted Selected</button>

            </table>
        </form>


        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Category</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>

                    @endif
                    @error('catagory_name')
                    <strong class='text-danger'>{{$message}}</strong>
                  @enderror

                <form action="{{url('/category/insert')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Category Name</label>
                        <input name="catagory_name" type="text" class="form-control" >
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Category Image</label>
                        <input name="category_image" type="file" class="form-control" >
                      </div>
                      @error('category_image')
                      <strong class='text-danger'>{{$message}}</strong>
                    @enderror
                      <button type="sumbit" class="btn btn-primary"> Submit</button>

                </form>
        </div>

                </div>
            </div>
        </div>

    </div>
</div>

<div class="container-fluid">
    <div class="row">

        <div class="col-lg-8">


            <table class="table table-bordered">
                @if (session('force_deleted'))
                <div class="alert alert-primary">{{session('force_deleted')}}</div>
                @endif
                <table class="table table-bordered">
                    @if (session('restore_all'))
                    <div class="alert alert-primary">{{session('restore_all')}}</div>
            @endif
            <tr><th colspan="5" class="m-auto">Trashed</th></tr>

                <tr>
                    <th><input type="checkbox" name="" id="parent"></th>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Added By</th>
                    <th>image</th>
                    <th>Created At</th>
                    <th>Deleted At</th>
                    <th>Action</th>
                </tr>
                @forelse ($soft as $key=>$item2 )

                <tr>
                    <td><input type="checkbox" name="restore[]" id="child"></td>
                        <td>{{$key+1}}</td>
                        <td>{{$item2->catagory_name}}</td>

                        <td>{{App\Models\User::find($item2->added_by)->name}}</td>
                    <td><img width="50px" src="{{asset('uploads/category')}}/{{$item2->category_image}}" alt=""></td>

                    <td>{{$item2->created_at->diffforHumans()}}</td>
                    <td>{{$item2->deleted_at->diffforHumans()}}</td>

                    <td><a href="{{route('force_delete', $item2->id )}}" Class="btn btn-danger">Permanent<br>Delete</a></td>
                    <td><a href="{{route('restore', $item2->id )}}" Class="btn btn-primary">Restore</a></td>
                </tr>
                @empty
                <tr>

                    <td colspan="5" class="m-auto"><h3> NO data found</h3></td>
                </tr>

                @endforelse
            </table>



        </div>
        </div>
    </div>
</div>
<script>
 $(document).ready(function() {
  $("#parent").click(function() {
    $(".child").prop("checked", this.checked);
  });

</script>
<script>
    $("#selectAll").click(function(){
        $("#select1").prop('checked', $(this).prop('checked'));

});
   </script>



 @endsection
