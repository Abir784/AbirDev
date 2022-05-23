@include('frontend.main_haeder')
<div class="container">

    <div class="row">
        <div class="card mt-5">
              <div class="card-header bg-white mt-5">
                  <h2 class="text-center">Product Comparison</h2>
              </div>
            <div class="card-body mt-5">
                <table class="table table-hover table-responsive-lg m-auto ">
                    <tr>
                        <th>

                        </th>
                        <th>
                            <img src="{{asset('uploads/product/product_preview/')}}/{{$prod1->product_image}}" alt="{{$prod1->product_image}}">
                        </th>
                        <th>
                            <img src="{{asset('uploads/product/product_preview/')}}/{{$prod2->product_image}}" alt="{{$prod2->product_image}}">
                        </th>
                    </tr>
                    <tr class="bg-warning">
                        <th scope="col">Category</th>
                        <td>{{$prod1->rel_to_category->catagory_name}}</td>
                        <td>{{$prod2->rel_to_category->catagory_name}}</td>

                    </tr>
                    <tr class="bg-white">
                        <th scope="col">Sub-Category</th>
                        <td>{{$prod1->rel_to_subcategory->subcategory_name}}</td>
                        <td>{{$prod2->rel_to_subcategory->subcategory_name}}</td>

                    </tr>
                    <tr class="bg-warning">
                        <th scope="col">Brand</th>
                        <td>{{$prod1->brand}}</td>
                        <td>{{$prod2->brand}}</td>

                    </tr>
                    <tr class="bg-white">
                        <th>Name</th>
                        <td>{{$prod1->product_name}}</td>
                        <td>{{$prod2->product_name}}</td>

                    </tr>
                    <tr class="bg-warning">

                        <th scope="col">Price</th>
                        <td>Tk {{$prod1->after_discount}}</td>
                        <td>Tk {{$prod2->after_discount}}</td>

                    </tr>
                    <tr class="bg-white">

                        <th scope="col">Description</th>
                        <td>{{$prod1->desp}}</td>
                        <td>{{$prod1->desp}}</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>

@include('frontend.footer')
