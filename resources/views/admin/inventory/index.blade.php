@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Inventory Of {{$products->product_name}}</h3>

                </div>
                <div class="card-body">
                    @if (session('session'))
                    <div class="alert alert-success">
                        {{session('session')}}
                    </div>

                    @endif
            <table class="table table-striped">
                <thead>
                    <th>SL</th>
                    <th>Color Variants</th>
                    <th>Sizes</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </thead>
                @forelse ($inventories as $key=>$inventory )
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$inventory->rel_color->name}}</td>
                        <td>{{$inventory->rel_size->name}}</td>
                        <td>{{$inventory->quantity}}</td>
                        <td><a href="{{route('inventory.delete.index', $inventory->id)}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>


                        @empty
                        <td colspan="4"><div class="alert alert-primary">No data found</div></td>
                    </tr>

                @endforelse
            </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                   <h3>Add Inventory </h3>
                </div>
                <div class="card-body">

                    <form action="{{url('/add/inventory')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="product_id" value="{{$products->id}}" >
                            <select name="color_id" class="form-control">
                                <option value="">--Select Color--</option>
                                @foreach ($colors as $color)
                                <option value="{{$color->id}}">{{$color->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <select name="size_id" class="form-control">
                                <option value="">--Select size--</option>
                                @foreach ($sizes as $size)
                                <option value="{{$size->id}}">{{$size->name}}</option>
                                @endforeach
                            </select>
                            <div class="mt-3">
                                <input type="number" name='quantity' placeholder="Enter Quantity In Stock" class="form-control">
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
