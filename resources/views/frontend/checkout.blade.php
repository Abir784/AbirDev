@include('frontend.main_haeder')
  <!-- main body - start
        ================================================== -->

            <!-- breadcrumb_section - start
            ================================================== -->
            <div class="breadcrumb_section">
                <div class="container">
                    <ul class="breadcrumb_nav ul_li">
                        <li><a href="{{route('frontend.index')}}">Home</a></li>
                        <li>Check Out</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->



            <main>

            <!-- checkout-section - start
            ================================================== -->
            <section class="checkout-section section_space">
                <div class="container">
                   <div class="row">
                      <div class="col col-xs-12">
                         <div class="woocommerce bg-light p-3">
                            <form  method="post" class="checkout woocommerce-checkout" action="{{url('/order/placed')}}" >
                                @csrf
                               <div class="col2-set" id="customer_details">
                                  <div class="coll-1">
                                     <div class="woocommerce-billing-fields">
                                        <h3>Billing Details</h3>
                                        <input type="hidden" name="user_id" value="{{Auth::guard('customerlogin')->id()}}">
                                        <p class="form-row form-row form-row-first validate-required" id="billing_first_name_field">
                                           <label for="billing_first_name" class="">First Name <abbr class="required" title="required">*</abbr></label>
                                           <input type="text" class="input-text " name="name" id="billing_first_name" placeholder="" autocomplete="given-name" value="{{Auth::guard('customerlogin')->user()->name}}" />
                                        </p>
                                        <p class="form-row form-row form-row-last validate-required validate-email" id="billing_email_field">
                                           <label for="billing_email"  class="">Email Address <abbr class="required" title="required">*</abbr></label>
                                           <input type="email" readonly class="input-text " name="email" id="billing_email" placeholder="" autocomplete="email" value="{{Auth::guard('customerlogin')->user()->email}}" />
                                        </p>
                                        <div class="clear"></div>
                                        <p class="form-row form-row form-row-first" id="billing_company_field">
                                           <label for="company_name" class="">Company Name</label>
                                           <input type="text" class="input-text " name="company" id="billing_company" placeholder="" autocomplete="organization" value="" />
                                        </p>

                                        <p class="form-row form-row form-row-last validate-required validate-phone" id="billing_phone_field">
                                           <label for="phone" class="">Phone <abbr class="required" title="required">*</abbr></label>
                                           <input type="tel" class="input-text " name="phone" id="billing_phone" placeholder="" autocomplete="tel" value="" />
                                        </p>
                                        <div class="clear"></div>
                                        <p class="form-row form-row form-row-first address-field update_totals_on_change validate-required" id="billing_country_field">
                                           <label for="billing_country" class="">Country <abbr class="required" title="required">*</abbr></label>
                                           <select name="country_id" class="country" >
                                              <option value="">Select a country&hellip;</option>
                                              @foreach ($countries as $country )
                                              <option value="{{$country->id}}">{{$country->name}}</option>
                                              @endforeach
                                           </select>
                                        </p>
                                        <p class="form-row form-row form-row-last address-field update_totals_on_change validate-required" id="billing_country_field">
                                           <label for="billing_country" class="">City <abbr class="required" title="required">*</abbr></label>
                                           <select name="city_id" id="city">
                                              <option value="">Select a City&hellip;</option>
                                           </select>
                                        </p>
                                        <p class="form-row form-row form-row-wide address-field validate-required" id="billing_address_1_field">
                                           <label for="billing_address_1" class="">Address <abbr class="required" title="required">*</abbr></label>
                                           <input type="text" class="input-text " name="address" id="billing_address_1" placeholder="Street address" autocomplete="address-line1" value="" />
                                        </p>
                                     </div>
                                     <p class="form-row form-row notes" id="order_comments_field">
                                           <label for="order_comments" class="">Order Notes</label>
                                           <textarea name="notes" class="input-text " id="order_comments" placeholder="Notes about your order, e.g. special notes for delivery." rows="2" cols="5"></textarea>
                                        </p>
                                  </div>
                               </div>
                               <h3 id="order_review_heading">Your order</h3>
                               <div id="order_review" class="woocommerce-checkout-review-order">
                                  <table class="shop_table woocommerce-checkout-review-order-table">
                                        <tr class="cart-subtotal">
                                           <th>Subtotal</th>
                                           <input type="hidden" name="total" value="{{$total}}">
                                           <td>BDT <span class="woocommerce-Price-amount amount total_price1">{{$total}}</span>
                                           </td>
                                        </tr>
                                        <tr class="cart-subtotal">
                                           <th>Discounted Price </th>
                                           <input type="hidden" name="discount" value="{{$discounted_price=$total*(session('discount')/100)}}">
                                           <td>BDT <span class="woocommerce-Price-amount amount discount">{{$discounted_price=$total*(session('discount')/100)}}</span>
                                           </td>
                                        </tr>
                                        <tr class="mt-2">
                                            <td>
                                                <h6>Select Location</h6>
                                                <input id="in"  type="radio" class="input-radio delivery" name="delivery_location" value="60" checked='checked' data-order_button_text="Proceed to SSL Commerz"  />
                                                <label for="in">Inside Dhaka</label>
                                                <br>
                                                <input id="out" type="radio" class="input-radio delivery" name="delivery_location" value="100" data-order_button_text="Proceed to SSL Commerz"  />
                                                <label for="out">Outside Dhaka</label>


                                            </td>
                                        </tr>
                                        <tr class="shipping">
                                           <th>Delivery Charge</th>
                                           <td data-title="Shipping">
                                            BDT <span class="woocommerce-Price-currencySymbol charge_show">60</span>
                                           </td>
                                        </tr>
                                        <tr class="order-total">
                                           <th>Total</th>
                                           <td><strong>BDT <span class="woocommerce-Price-amount amount grand_price">{{($total-$discounted_price)+60}}</strong> </td>
                                        </tr>
                                  </table>
                                  <div id="payment" class="woocommerce-checkout-payment py-3 mt-5">
                                     <ul class="wc_payment_methods payment_methods methods">
                                        <li class="wc_payment_method payment_method_cheque mb-2">
                                           <input id="payment_method_cheque" type="radio" class="input-radio" name="delivery_method" value="1" checked='checked' data-order_button_text="" />
                                           <!--grop add span for radio button style-->
                                           <span class='grop-woo-radio-style'></span>
                                           <!--custom change-->
                                           <label for="payment_method_cheque">Cash On Delivery</label>
                                        </li>
                                        <li class="wc_payment_method payment_method_paypal mb-2">
                                           <input id="payment_method_ssl" type="radio" class="input-radio" name="delivery_method" value="2" data-order_button_text="Proceed to SSL Commerz" />
                                           <!--grop add span for radio button style-->
                                           <span class='grop-woo-radio-style'></span>
                                           <!--custom change-->
                                           <label for="payment_method_ssl">SSL Commerz</label>
                                        </li>
                                        <li class="wc_payment_method payment_method_paypal">
                                           <input id="payment_method_stripe" type="radio" class="input-radio" name="delivery_method" value="3" data-order_button_text="Proceed to SSL Commerz" />
                                           <!--grop add span for radio button style-->
                                           <span class='grop-woo-radio-style'></span>
                                           <!--custom change-->
                                           <label for="payment_method_stripe">Stripe Payment</label>
                                        </li>
                                     </ul>
                                     <div class="form-row place-order">
                                        <input type="submit" class="button alt" id="place_order" value="Place order" data-value="Place order" />

                                     </div>
                                  </div>
                               </div>
                            </form>
                         </div>
                      </div>
                   </div>
                </div>
             </section>
             <!-- checkout-section - end
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
    $('.country').change(function(){
        var country_id =$(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
                type:'POST',
                url:'/getCities',
                data:{'country_id':country_id},
                success:function(data){
                    $('#city').html(data);
                }
            });




    });
</script>
<script>
    $('.delivery').click(function(){
        var charge = $(this).val();
        var sub_total = $('.total_price1').text();
        var discount = $('.discount').text();
        var grand_total= (parseInt(sub_total)-parseInt(discount))+parseInt(charge);
        $('.grand_price').html(grand_total);
        $('.charge_show').html(charge);

        })
</script>
@if (session('session'))
<script>
    Swal.fire(
        'Thank You For Shopping',
        'Order Placed',
        'success'
    )
</script>
    @endif

@endsection

@include('frontend.footer')
