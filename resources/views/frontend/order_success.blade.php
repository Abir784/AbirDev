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
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @if (session('order_success'))
                <h2 class="mt-5 m-auto"> {{session('order_success')}}</h2>
            @endif
        </div>
    </div>
</div>


@include('frontend.footer')
