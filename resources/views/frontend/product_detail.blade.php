@extends('frontend.components.master')
@section('title', 'Home')

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
                    <a href="index.html">
                        <img src="assets/img/logo/logo-white.png" alt="logo">
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
        <div class="width-control">
            <!-- breadcrumb__area-start -->
            <section class="breadcrumb__area box-plr-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__wrapper">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb__area-end -->

            <!-- product-details-start -->
            <div class="product-details">
                <div class="container">
                    <h1 class="text-center custom-heading-color">{{ ucwords($product->product_title) }}</h1>
                    <div class="row" style="display: flex; justify-content: center">
                        <div class="col-xl-6">
                            <div class="product__details-nav d-sm-flex flex-column">
                                <div class="product__details-thumb">
                                    <div class="tab-content" id="productThumbContent">
                                        <div class="tab-pane fade show active" id="thumbOne" role="tabpanel" aria-labelledby="thumbOne-tab">
                                            @php
                                                $img = (!empty($product->product_image)) ? $product->product_image : "No-Image.png";
                                            @endphp
                                            <div class="product__details-nav-thumb w-img">
                                                <img src="{{ asset('images'."/". $img) }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <div class="col-xl-6">--}}
{{--                            <div class="product__details-content">--}}
{{--                                --}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
            <!-- product-details-end -->

            <!-- product-details-des-start -->
            <div class="product-details-des mt-40 mb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="product__details-des-tab">
                                <ul class="nav nav-tabs" id="productDesTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="des-tab" data-bs-toggle="tab" data-bs-target="#des" type="button" role="tab" aria-controls="des" aria-selected="true">Product Description </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="prodductDesTaContent">
                        <div class="tab-pane fade active show" id="des" role="tabpanel" aria-labelledby="des-tab">
                            <div class="product__details-des-wrapper">
                                <p class="des-text mb-35">{{ $product->product_description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- product-details-des-end -->
        </div>

    </main>
@endsection
