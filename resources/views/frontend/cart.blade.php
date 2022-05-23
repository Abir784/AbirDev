@include('frontend.main_haeder')
 <!-- breadcrumb_section - start
            ================================================== -->
            <div class="breadcrumb_section">
                <div class="container">
                    <ul class="breadcrumb_nav ul_li">
                        <li><a href="{{route('frontend.index')}}">Home</a></li>
                        <li>Cart</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->
       <!-- main body - start
        ================================================== -->
        <main>
            <!-- cart_section - start
            ================================================== -->
            <section class="cart_section section_space">
                <div class="container">

                    <div class="cart_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Price (BDT)</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Total (BDT)</th>
                                    <th class="text-center">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total=0;
                                @endphp
                                @foreach ($carts as $cart )

                                <tr>
                                    <td>
                                        <div class="cart_product">
                                            <img src="{{asset('uploads/product/product_preview')}}/{{$cart->rel_to_products->product_image}}" alt="image_not_found">
                                            <h3><a href="shop_details.html">{{ $cart->rel_to_products->product_name}}</a></h3>
                                        </div>
                                    </td>
                                    <td class="text-center abc"><span class="price_text">{{$cart->rel_to_products->after_discount}}</span></td>
                                    <td class="text-center abc">
                                        <form action="{{url('/cart/update')}}" method="POST">
                                            @csrf
                                            <div class="quantity_input">
                                                <button type="button" class="input_number_decrement">
                                                    <i data-price="{{$cart->rel_to_products->after_discount}}" class="fal fa-minus"></i>
                                                </button>
                                                <input class="input_number8" name="quantity[{{$cart->id}}]" type="text" readonly value="{{$cart->quantity}}" />
                                                <button type="button" class="input_number_increment">
                                                    <i data-price="{{$cart->rel_to_products->after_discount}}" class="fal fa-plus"></i>
                                                </button>
                                            </div>
                                    </td>
                                    <td class="text-center abc"><span class="price_text"> {{$cart->rel_to_products->after_discount*$cart->quantity}}</span></td>
                                    <td class="text-center"><a href="{{route('cart.delete', $cart->id)}}" class="remove_btn"><i class="fal fa-trash-alt"></i></a></td>
                                </tr>
                                @php
                                    $total+=$cart->rel_to_products->after_discount*$cart->quantity;
                                @endphp

                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="cart_btns_wrap">
                        <div class="row">

                            <div class="col col-lg-6">
                                <ul class="btns_group ul_li_right">
                                    <li><button  class="btn border_black" type="submit">Update Cart</button></li>
                                    <li><a class="btn btn_dark" href="{{route('checkout')}}">Prceed To Checkout</a></li>
                                </ul>
                            </div>
                       </form>
                            <div class="col col-lg-6">
                                <form action="{{url('/cart')}}" method="GET">
                                    @csrf
                                    <div class="coupon_form form_item mb-0">
                                        <input type="text" name="coupon_code" placeholder="Coupon Code...">
                                        <button type="submit" class="btn btn_dark">Apply Coupon</button>


                                        <div class="info_icon">
                                            <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Type your Coupon Code Here"></i>
                                        </div>
                                    </div>
                                    @if ($message)
                                    <div class="alert alert-danger alert-dismissible fade show form-control mt-2">{{$message}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                                    @endif
                            </div>
                        </form>

                        </div>
                    </div>

                    <div class="row">


                        <div class="col col-lg-12">
                            <div class="cart_total_table">
                                <h3 class="wrap_title">Cart Totals</h3>
                                <ul class="ul_li_block">
                                    <li>
                                        <span>Cart Subtotal</span>
                                        <span>BDT {{$total}}</span>
                                    </li>
                                    <li>
                                        <span>Discount %</span>
                                        <span>{{$discount}} %</span>
                                    </li>
                                    <li>
                                        <span>Order Total</span>
                                        <span class="total_price">BDT {{($total-($total*$discount)/100)}}</span>
                                    </li>
                                </ul>
                            </div>
                            @php
                                session([
                                    'discount'=>$discount,
                                ])
                            @endphp
                        </div>
                    </div>
                </div>
            </section>
            <!-- cart_section - end
            ================================================== -->

            <!-- newsletter_section - start
            ================================================== -->
            <section class="newsletter_section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-lg-6">
                            <h2 class="newsletter_title text-white">Sign Up for Newsletter </h2>
                            <p>Get E-mail updates about our latest products and special offers.</p>
                        </div>
                        <div class="col col-lg-6">
                            <form action="#!">
                                <div class="newsletter_form">
                                    <input type="email" name="email" placeholder="Enter your email address">
                                    <button type="submit" class="btn btn_secondary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- newsletter_section - end
            ================================================== -->

        </main>
        <!-- main body - end
        ================================================== -->


@section('footer_script')
<script>
    let quantity_input = document.querySelectorAll('.abc')
    let arr = Array.from(quantity_input)

    arr.map(item=>{
        item.addEventListener('click', function(e){

            if(e.target.className == 'fal fa-plus'){
                e.target.parentElement.previousElementSibling.value++
                let quantity =  e.target.parentElement.previousElementSibling.value
                let price = e.target.dataset.price
                item.nextElementSibling.innerHTML = price*quantity

            }
            if(e.target.className == 'fal fa-minus'){
                if(e.target.parentElement.nextElementSibling.value>1){
                    e.target.parentElement.nextElementSibling.value--
                    let quantity =  e.target.parentElement.nextElementSibling.value
                    let price = e.target.dataset.price
                    item.nextElementSibling.innerHTML = price*quantity
                }
            }
        })
    });
</script>
@if(session('cart_update'))
<script>
    Swal.fire(
    'Cart Updated',
    'Succesfully!',
    'success'
    )
</script>
@endif
@endsection

@include('frontend.footer')



