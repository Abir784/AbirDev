@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <table class="table table-striped">
                <thead>
                    <th>SL</th>
                    <th>Color Name</th>
                </thead>
                 @forelse ( $colors as $key=>$color )


                 <tr>
                     <td>{{$key+1}}</td>
                     <td>{{$color->name}}</td>

                     @empty
                     <td>No Data Found</td>
                    </tr>


                    @endforelse
            </table>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                   <h3>Add color</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('add/color')}}" method="post">
                        @csrf
                     <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Enter Color" name="color_name">
                     </div>
                     <div class="mb-3">
                         <button type="submit" class="btn btn-primary">Submit</button>
                     </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
