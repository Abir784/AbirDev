@include('frontend.main_haeder')
<!-- main body - start
        ================================================== -->
        <main>

            <!-- sidebar cart - start
            ================================================== -->
            <div class="sidebar-menu-wrapper">
                <div class="cart_overlay"></div>
            </div>
            <!-- sidebar cart - end
            ================================================== -->

            <!-- breadcrumb_section - start
            ================================================== -->
            <div class="breadcrumb_section">
                <div class="container">
                    <ul class="breadcrumb_nav ul_li">
                        <li><a href="index.html">Home</a></li>
                        <li>Login/Register</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->

            <!-- register_section - start
            ================================================== -->
            <section class="register_section section_space">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">

                            <ul class="nav register_tabnav ul_li_center" role="tablist">
                                <li role="presentation">
                                    <button class="active" data-bs-toggle="tab" data-bs-target="#signin_tab" type="button" role="tab" aria-controls="signin_tab" aria-selected="true">Sign In</button>
                                </li>
                                <li role="presentation">
                                    <button data-bs-toggle="tab" data-bs-target="#signup_tab" type="button" role="tab" aria-controls="signup_tab" aria-selected="false">Register</button>
                                </li>
                            </ul>

                            <div class="register_wrap tab-content">
                                <div class="tab-pane fade show active" id="signin_tab" role="tabpanel">
                                    <form action="{{url('/customer/login/')}}" method="POST">
                                        @csrf
                                        <div class="form_item_wrap">
                                            <h3 class="input_title"> Email*</h3>
                                            <div class="form_item">
                                                <label for="username_input"><i class="fas fa-user"></i></label>
                                                <input id="username_input" type="email" name="email" placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="form_item_wrap">
                                            <h3 class="input_title">Password*</h3>
                                            <div class="form_item">
                                                <label for="password_input"><i class="fas fa-lock"></i></label>
                                                <input id="password_input" type="password" name="password" placeholder="Password">
                                            </div>
                                            <div class="checkbox_item">
                                                <a href="{{route('customer.password.reset.req')}}" >Forgot Password?</a>
                                            </div>
                                        </div>

                                        <div class="form_item_wrap">
                                            <button type="submit" class="btn btn_primary">Sign In</button>
                                            <a href="{{url('/github/redirect')}}" class="btn btn_primary">Login with Github</a>
                                            <a href="{{url('/google/redirect')}}" class="btn btn_primary">Login with Google</a>
                                        </div>

                                    </form>
                                </div>

                                <div class="tab-pane fade" id="signup_tab" role="tabpanel">
                                    <form action="{{url('/customer/register')}}" method="POST">
                                        @csrf
                                        <div class="form_item_wrap">
                                            <h3 class="input_title">Name*</h3>
                                            <div class="form_item">
                                                <label for="username_input2"><i class="fas fa-user"></i></label>
                                                <input id="username_input2" type="text" name="name" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form_item_wrap">
                                            <h3 class="input_title">Email*</h3>
                                            <div class="form_item">
                                                <label for="email_input"><i class="fas fa-envelope"></i></label>
                                                <input id="email_input" type="email" name="email" placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="form_item_wrap">
                                            <h3 class="input_title">Password*</h3>
                                            <div class="form_item">
                                                <label for="password_input2"><i class="fas fa-lock"></i></label>
                                                <input id="password_input2" type="password" name="password" placeholder="Password">
                                            </div>
                                        </div>

                                        <div class="form_item_wrap">
                                            <button type="submit" class="btn btn_secondary">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- register_section - end
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


@include('frontend.footer')

