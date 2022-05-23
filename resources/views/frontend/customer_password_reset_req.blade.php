@include('frontend.main_haeder')
 <!-- breadcrumb_section - start
            ================================================== -->
            <div class="breadcrumb_section">
                <div class="container">
                    <ul class="breadcrumb_nav ul_li">
                        <li><a href="{{route('frontend.index')}}">Home</a></li>
                        <li>Password Reset</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="card my-5">
                        @if(session('session'))
                        <h3>
                            <div class="alert alert-success mt-3"> {{session('session')}}</div>
                        </h3>
                            @else
                        <div class="card-header">
                           <h5>Send Reset Link</h5>
                        </div>
                        <div class="card-body">

                            <form action="{{route('customer.password.reset.store')}}" method="post">
                                @csrf
                                <div class="mt-3">
                                    <input placeholder="Enter Your Email" type="email" name="email" class="form-control">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Send Link</button>
                                </div>
                            </form>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>



@include('frontend.footer')
