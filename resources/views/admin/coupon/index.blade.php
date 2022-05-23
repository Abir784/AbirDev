@extends('layouts.dashboard')
 @section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">

            <table class="table table-bordered">

            <tr><th colspan="5" class="m-auto"><h4>Coupon Info</h4></th></tr>
                <tr>
                    <th>SL</th>
                    <th>Coupon Code</th>
                    <th>Discount</th>
                    <th>Validity</th>
                    <th>Action</th>
                </tr>

                @forelse ($coupon as $key=>$item )

                <tr>

                    <td>{{$key+1}}</td>
                    <td>{{$item->coupon_code}}</td>
                    <td>{{$item->discount}} %</td>
                    <td>{{$item->validity}}</td>
                    <td>{{$item->created_at->diffforHumans()}}</td>
                </tr>

                @empty
                    <td colspan="5" class="m-auto">No data found</td>

                @endforelse



            </table>


        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Coupon</h3>
                </div>
                <div class="card-body">

                <form action="{{url('/coupon/insert')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Coupon Code</label>
                        <input name="coupon_code" type="text" class="form-control" >
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Discount %</label>
                        <input name="discount" type="text" class="form-control" >
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Validity</label>
                        <input name="validity" type="date" class="form-control" >
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
