@extends('frontend.components.master')
@section('title', 'Contact - Form')
<!-- header-end -->

@section('content')
    <!-- offcanvas area start -->
    <div class="offcanvas__area">
        <div class="offcanvas__wrapper">
            <div class="offcanvas__close">
                <button class="offcanvas__close-btn" id="offcanvas__close-btn">
                    <i class="fal fa-times"></i>
                </button>
            </div>
            <div class="offcanvas__content">
                <div class="offcanvas__logo mb-40">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/img/logo/logo-white.png') }}" alt="logo">
                    </a>
                </div>
                <div class="offcanvas__search mb-25">
                    <form action="#">
                        <input type="text" placeholder="What are you searching for?">
                        <button type="submit" ><i class="far fa-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu fix"></div>
                <div class="offcanvas__action">

                </div>
            </div>
        </div>
    </div>
    <!-- offcanvas area end -->
    <div class="body-overlay"></div>
    <!-- offcanvas area end -->

    <main>
        <!-- page-banner-area-start -->
        <div class="page-banner-area page-banner-height" data-background="assets/img/banner/page-banner-3.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page-banner-content text-center">
                            <h4 class="breadcrumb-title">Contact Us</h4>
                            <div class="breadcrumb-two">
                                <nav>
                                    <nav class="breadcrumb-trail breadcrumbs">
                                        <ul class="breadcrumb-menu">
                                            <li class="breadcrumb-trail">
                                                <a href="{{ url('/') }}"><span>Home</span></a>
                                            </li>
                                            <li class="trail-item">
                                                <span>Contact Us</span>
                                            </li>
                                        </ul>
                                    </nav>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page-banner-area-end -->

        <div class="container">
            <!--Section: Contact v.2-->
            <section class="mb-4">

                <!--Section heading-->
                <h2 class="h1-responsive font-weight-bold text-center my-4 custom-price-color">Contact us</h2>
                <!--Section description-->
                <p class="text-center w-responsive mx-auto mb-5 custom-heading-color">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
                    a matter of hours to help you.</p>

                <div class="row mt-3">

                    <!--Grid column-->
                    <div class="col-md-6 mb-md-0 mb-5 mx-auto">
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf

                            <!--Grid row-->
                            <div class="row">
                                <!--Grid column-->
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <label for="name" class="">Your name</label>
                                        <input type="text" id="name" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <!--Grid column-->

                                <!--Grid column-->
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <label for="email" class="">Your email</label>
                                        <input type="email" id="email" name="email" class="form-control" required>
                                    </div>
                                </div>
                                <!--Grid column-->

                            </div>
                            <!--Grid row-->

                            <!--Grid row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form mb-0">
                                        <label for="subject" class="">Subject</label>
                                        <input type="text" id="subject" name="subject" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <!--Grid row-->

                            <!--Grid row-->
                            <div class="row">
                                <!--Grid column-->
                                <div class="col-md-12">
                                    <div class="md-form">
                                        <label for="message">Your message</label>
                                        <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--Grid row-->

                            <div class="text-center text-md-left mt-3">
                                <button type="submit" class="btn btn-primary custom-btn w-100">Send</button>
                                {{--                            <a class="btn btn-primary custom-btn w-100">Send</a>--}}
                            </div>
                        </form>
{{--                        <div class="status"></div>--}}
                    </div>
                    <!--Grid column-->
                </div>
            </section>
            <!--Section: Contact v.2-->
        </div>

        <!-- location-area-start -->
        <div class="location-area pt-70 pb-25">
            <div class="container">
                <div class="row mb-25">

                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="location-item mb-30">
                            <h6>26 Rue Pelleport - Paris</h6>
                            <div class="sm-item-loc sm-item-border mb-20">
                                <div class="sml-icon mr-20">
                                    <i class="fal fa-map-marker-alt custom-icon "></i>
                                </div>
                                <div class="sm-content">
                                    <span>Find us</span>
                                    <p>Rue Saint-Antoine, Paris, France  </p>
                                </div>
                            </div>
                            <div class="sm-item-loc sm-item-border mb-20">
                                <div class="sml-icon mr-20">
                                    <i class="fal fa-phone-alt custom-icon "></i>
                                </div>
                                <div class="sm-content">
                                    <span>Call us</span>
                                    <p><a href="tel:+8804568">(+100) 123 456 7890</a></p>
                                </div>
                            </div>
                            <div class="sm-item-loc mb-20">
                                <div class="sml-icon mr-20">
                                    <i class="fal fa-envelope custom-icon "></i>
                                </div>
                                <div class="sm-content">
                                    <span>Mail us</span>
                                    <p><a href="mailto:store@company.com">store@company.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="location-item mb-30">
                            <h6>150 Stanley Rd - London</h6>
                            <div class="sm-item-loc sm-item-border mb-20">
                                <div class="sml-icon mr-20">
                                    <i class="fal fa-map-marker-alt custom-icon "></i>
                                </div>
                                <div class="sm-content">
                                    <span>Find us</span>
                                    <p>Brick Ln, Spitalfields, London E1, UK</p>
                                </div>
                            </div>
                            <div class="sm-item-loc sm-item-border mb-20">
                                <div class="sml-icon mr-20">
                                    <i class="fal fa-phone-alt custom-icon "></i>
                                </div>
                                <div class="sm-content">
                                    <span>Call us</span>
                                    <p><a href="tel:+8804568">(+100) 123 456 7890</a></p>
                                </div>
                            </div>
                            <div class="sm-item-loc mb-20">
                                <div class="sml-icon mr-20">
                                    <i class="fal fa-envelope custom-icon "></i>
                                </div>
                                <div class="sm-content">
                                    <span>Mail us</span>
                                    <p><a href="mailto:store@company.com">store@company.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="location-item mb-30">
                            <h6>1357 Prospect - New York</h6>
                            <div class="sm-item-loc sm-item-border mb-20">
                                <div class="sml-icon mr-20">
                                    <i class="fal fa-map-marker-alt custom-icon "></i>
                                </div>
                                <div class="sm-content">
                                    <span>Find us</span>
                                    <p>Atlantic, Brooklyn, New York, US</p>
                                </div>
                            </div>
                            <div class="sm-item-loc sm-item-border mb-20">
                                <div class="sml-icon mr-20">
                                    <i class="fal fa-phone-alt custom-icon "></i>
                                </div>
                                <div class="sm-content">
                                    <span>Call us</span>
                                    <p><a href="tel:+8804568">(+100) 123 456 7890</a></p>
                                </div>
                            </div>
                            <div class="sm-item-loc mb-20">
                                <div class="sml-icon mr-20">
                                    <i class="fal fa-envelope custom-icon "></i>
                                </div>
                                <div class="sm-content">
                                    <span>Mail us</span>
                                    <p><a href="mailto:store@company.com">store@company.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="location-item mb-30">
                            <h6>86 Georgia Rd - Mardrid</h6>
                            <div class="sm-item-loc sm-item-border mb-20">
                                <div class="sml-icon mr-20">
                                    <i class="fal fa-map-marker-alt custom-icon "></i>
                                </div>
                                <div class="sm-content">
                                    <span>Find us</span>
                                    <p>Calle del Correo, 4, Madrid, Spain</p>
                                </div>
                            </div>
                            <div class="sm-item-loc sm-item-border mb-20">
                                <div class="sml-icon mr-20">
                                    <i class="fal fa-phone-alt custom-icon "></i>
                                </div>
                                <div class="sm-content">
                                    <span>Call us</span>
                                    <p><a href="tel:+8804568">(+100) 123 456 7890</a></p>
                                </div>
                            </div>
                            <div class="sm-item-loc mb-20">
                                <div class="sml-icon mr-20">
                                    <i class="fal fa-envelope custom-icon "></i>
                                </div>
                                <div class="sm-content">
                                    <span>Mail us</span>
                                    <p><a href="mailto:store@company.com">store@company.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- location-area-end -->

        <!-- cmamps-area-start -->
        <div class="cmamps-area">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1899531.5831083965!2d105.806381!3d21.58504!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x515f4860ede9e108!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5n!5e0!3m2!1sen!2sus!4v1644226635446!5m2!1sen!2sus"></iframe>
        </div>
        <!-- cmamps-area-end -->

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
        <!-- cta-area-end -->

    </main>
@endsection


