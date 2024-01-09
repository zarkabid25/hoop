@extends('auth.layout')

@section('title', 'Register')

@section('content')
    <div class="account-area mt-70 mb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="basic-login">
                        <h5 class="custom-price-color">Register</h5>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <label for="username">Username or email address  <span>*</span></label>
                            <input id="username" type="text" placeholder="Enter Username" name="name" class="@error('name') is-invalid @enderror" required autocomplete>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="email-id">Email Address <span>*</span></label>
                            <input id="email-id" type="text" placeholder="Email address..." name="email" class="@error('email') is-invalid @enderror" required autocomplete>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="userpass">Password <span>*</span></label>
                            <input id="userpass" name="password" type="password" placeholder="Enter password..." class="@error('password') is-invalid @enderror" required autocomplete>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="userpass">Confirm Password <span>*</span></label>
                            <input id="userpass" type="password" placeholder="Enter confirm password..." name="password_confirmation" class="@error('password_confirmation') is-invalid @enderror" required autocomplete>

                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="login-action mb-10 fix">
                                <p>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="#">privacy policy</a>.</p>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="register_button" class="tp-in-btn w-100 custom-btn">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- account-area-end -->

    <!-- cta-area-start -->
    <section class="cta-area d-ldark-bg pt-55 pb-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="cta-item cta-item-d mb-30">
                        <h5 class="cta-title">Follow Us</h5>
                        <p>We make consolidating, marketing and tracking your social media website easy.</p>
                        <div class="cta-social">
                            <div class="social-icon">
                                <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="youtube"><i class="fab fa-youtube"></i></a>
                                <a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="rss"><i class="fas fa-rss"></i></a>
                                <a href="#" class="dribbble"><i class="fab fa-dribbble"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="cta-item mb-30">
                        <h5 class="cta-title">Sign Up To Newsletter</h5>
                        <p>Join 60.000+ subscribers and get a new discount coupon  on every Saturday.</p>
                        <div class="subscribe__form">
                            <form action="#">
                                <input type="email" placeholder="Enter your email here...">
                                <button>subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="cta-item mb-30">
                        <h5 class="cta-title">Download App</h5>
                        <p>DukaMarket App is now available on App Store & Google Play. Get it now.</p>
                        <div class="cta-apps">
                            <div class="apps-store">
                                <a href="#"><img src="{{ asset('assets/img/brand/app_ios.png') }}" alt=""></a>
                                <a href="#"><img src="{{ asset('assets/img/brand/app_android.png') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

