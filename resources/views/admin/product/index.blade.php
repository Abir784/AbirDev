@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Product list</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-responsive-sm">
                        <thead>
                            <th>SL</th>
                            <th>Product Name</th>
                            <th>price</th>
                            <th>Discount</th>
                            <th>After Discount</th>
                            <th>Brand</th>
                            <th>product Image</th>
                        </thead>
                        @foreach ($products as $key=>$product)

                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->discount}} %</td>
                            <td>{{$product->after_discount}}</td>
                            <td>{{$product->brand}}</td>

                            <td><img width="100%" src="{{asset('uploads/product/product_preview')}}/{{$product->product_image}}" alt="" srcset=""></td>





                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="card-header bg-primary "><h3 class="text-white">Add Products</h3></div>
            <div class="card-body bg-white">
                @if (session('session'))
                <div class="alert alert-success">{{session('session')}}</div>


                @endif
                <form action="{{url('/product/insert')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">

                        <select class="form-control"  id="category_id" name="category_id">
                            <option  value=""> ---Select Category---</option>
                            @foreach ($catagory as $cat )

                            <option value="{{$cat->id}}" >{{$cat->catagory_name}}</option>

                            @endforeach

                        </select>
                    </div>
                    <div class="mb-3">

                        <select class="form-control" name="subcategory_id" id="subcategory">
                            <option value=""> ---Select Sub Category---</option>

                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="text" class='form-control' name='product_name' placeholder="Enter Product Name" value={{old('product_name')}}>
                    </div>
                    <div class="mb-3">
                        <input type="text" class='form-control' name='tittle' placeholder="Enter Product tittle" value={{old('tittle')}}>
                    </div>
                    <div class="mb-3">
                        <input type="text" class='form-control' name='price' placeholder="Enter Product Price" value={{old('price')}}>
                    </div>
                    <div class="mb-3">
                        <input type="text" class='form-control' name='discount' placeholder="Enter discount %">
                    </div>
                    <div class="mb-3">
                        <input type="text" class='form-control' name='brand' placeholder="Enter Product brand" value={{old('brand')}}>
                    </div>
                    <div class="mb-3">

                        <textarea name="desp" class="form-control" placeholder="Enter Description"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" name="product_image" class="custom-file-input">
                        <label class="custom-file-label">Choose Product Image</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" name="product_thumbnail_image[]" multiple class="custom-file-input">
                        <label class="custom-file-label">Choose Thumbnail Image</label>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('footer_script')



<script>
    $('#category_id').change(function(){
        var category_id = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

     $.ajax({
        type:'POST',
        url:'/getCategory',
        data:{'category_id':category_id},
        success:function(data){
            $('#subcategory').html(data);
        }

    });

})

</script>

@endsection
