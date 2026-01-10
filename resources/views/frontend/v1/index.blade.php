@extends('frontend.v1.layouts.master')
@section('title', 'E-SHOP || HOME PAGE')
@section('main-content')

    <!-- slider -->
    <section class="flat-spacing-3">
        <div class="tf-slideshow slider-radius slider-effect-fade position-relative">
            <div class="container">
                <div dir="ltr" class="swiper tf-sw-slideshow" data-preview="1" data-tablet="1" data-mobile="1"
                    data-centered="false" data-space="0" data-loop="true" data-auto-play="false" data-delay="2000"
                    data-speed="1000">
                    <div class="swiper-wrapper">
                        @foreach ($banners as $banner)
                            <div class="swiper-slide">
                                <div class="wrap-slider">
                                    <!-- Use dynamic image -->
                                    <img class="lazyload" data-src="{{ asset($banner->photo) }}"
                                        src="{{ asset($banner->photo) }}" alt="{{ $banner->title }}">

                                    <div class="box-content">
                                        <div class="container">
                                            <!-- Use dynamic title and description -->
                                            <h2
                                                class="fade-item fade-item-1 fw-6 text_white heading font-libre-baskerville mb_14">
                                                {!! $banner->title !!}
                                            </h2>
                                            <p class="fade-item fade-item-2 text_white">
                                                {!! $banner->description !!}
                                            </p>
                                            <a href="{{ $banner->shop_link }}"
                                                class="fade-item fade-item-3 tf-btn btn-light-icon animate-hover-btn btn-xl radius-3">
                                                <span>Shop Collection</span>
                                                <i class="icon icon-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="wrap-pagination">
                        <div class="container">
                            <div class="sw-dots line-white-pagination sw-pagination-slider justify-content-start">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /slider -->

    <!-- feature -->
    <section class="">
        <div class="container">
            <div class="flat-title flex-row justify-content-between align-items-center px-0 wow fadeInUp"
                data-wow-delay="0s">
                <h3 class="title font-libre-baskerville fw-7">Hot Deal</h3>
            </div>
            <div class="wrap-carousel">
                <div dir="ltr" class="swiper tf-sw-testimonial" data-preview="3" data-tablet="2" data-mobile="1"
                    data-space-lg="30" data-space-md="15">
                    <div class="swiper-wrapper">
                        @foreach ($hotProducts as $item)
                            <div class="swiper-slide">
                                <div class="collection-item-v4 hover-img" style="height: 700px; width: 100%;">
                                    <div class="collection-inner">
                                        <a href="shop-collection-sub.html" class="collection-image img-style radius-20">
                                            <img class="lazyload" data-src={{ asset($item->photo) }}
                                                src={{ asset($item->photo) }} alt="collection-img" height="300"
                                                width="400">
                                        </a>
                                        <div class="collection-content wow fadeInUp" data-wow-delay="0s">
                                            <p class="subheading text_white">{{ $item->discount }}% OFF</p>
                                            <h5 class="heading text_white">{{ $item->title }}
                                            </h5>
                                            <a href="shop-collection-list.html"
                                                class="tf-btn style-2 btn-light-icon radius-3 animate-hover-btn border-0">Shop
                                                now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="sw-dots style-2 sw-pagination-testimonial justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /feature -->

    <!-- Collection -->
    <section class="flat-spacing-12">
        <div class="container">
            <div class="flat-title flex-row justify-content-between align-items-center px-0 wow fadeInUp"
                data-wow-delay="0s">
                <h3 class="title font-libre-baskerville fw-7">Categories</h3>
                <a href="shop-collection-sub.html" class="tf-btn btn-line">View all categories<i
                        class="icon icon-arrow1-top-left"></i></a>
            </div>
            <div class="hover-sw-nav hover-sw-2">
                <div dir="ltr" class="swiper tf-sw-collection" data-preview="6" data-tablet="3" data-mobile="2"
                    data-space-lg="50" data-space-md="30" data-space="15" data-loop="false" data-auto-play="false">
                    <div class="swiper-wrapper">
                        @foreach ($category_count as $category)
                            <!-- Loop through categories -->
                            <div class="swiper-slide" lazy="true">
                                <div class="collection-item-circle hover-img">
                                    <a href="shop-collection-sub.html" class="collection-image img-style"
                                        style="width: 100%; height: 200px; overflow: hidden;">
                                        <!-- Use dynamic image (category image) -->
                                        <img class="lazyload category-image" data-src="{{ asset($category->photo) }}"
                                            src="{{ asset($category->photo) }}" alt="collection-img">
                                    </a>
                                    <div class="collection-content text-center">
                                        <a href="shop-collection-sub.html"
                                            class="link title fw-5">{{ $category->title }}</a>
                                        <!-- Display the product count -->
                                        <div class="count">{{ $category->product_count }} items</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="sw-dots style-2 sw-pagination-collection justify-content-center"></div>
            </div>
        </div>
    </section>


    <!-- /Collection -->

    <!-- banner -->
    <section class="flat-spacing-25 pb_0">
        <div class="container">
            <div
                class="widget-card-store type-3 hover-img radius-20 overflow-hidden align-items-center tf-grid-layout md-col-2 bg_light-blue-2">
                <div class="store-item-info">
                    <h5 class="store-heading font-libre-baskerville fw-7">{!! $single_blog->title !!}</h5>
                    <div class="description">
                        <p class="">{!! $single_blog->quote !!}</p>
                    </div>
                    <div class="wow fadeInUp" data-wow-delay="0s">
                        <a href="shop-default.html" class="tf-btn btn-line fw-6">Shop Collection<i
                                class="icon icon-arrow1-top-left"></i></a>
                    </div>
                </div>
                <div class="store-img img-style">
                    <img class="lazyload" data-src={{ asset($single_blog->photo) }} src={{ asset($single_blog->photo) }}
                        alt="store-img">
                </div>
            </div>
        </div>
    </section>
    <!-- /banner -->

    <!-- tab -->
    <section class="flat-spacing-12">
        <div class="container">
            <div class="flat-animate-tab">
                <div class="flat-title flex-row justify-content-between align-items-center px-0 flex-wrap wow fadeInUp"
                    data-wow-delay="0s">
                    <h3 class="title font-libre-baskerville fw-7">Top Trending Products</h3>
                    @if ($categoriesForTabs->count() > 0)
                        <ul class="widget-tab-5 d-flex wow fadeInUp mb-0" data-wow-delay="0s" role="tablist">
                            <li class="nav-tab-item" role="presentation">
                                <a href="#all-genres" class="active fw-6 rounded-0" data-bs-toggle="tab">
                                    All Trending ({{ $allTrendingProducts->count() }})
                                </a>
                            </li>
                            @foreach ($categoriesForTabs as $category)
                                @php
                                    $categoryProductCount = isset($trendingProductsByCategory[$category->title])
                                        ? $trendingProductsByCategory[$category->title]->count()
                                        : 0;
                                @endphp
                                @if ($categoryProductCount > 0)
                                    <li class="nav-tab-item" role="presentation">
                                        <a href="#{{ \Illuminate\Support\Str::slug($category->title) }}"
                                            class="fw-6 rounded-0" data-bs-toggle="tab">
                                            {{ $category->title }} ({{ $categoryProductCount }})
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>

                @if ($allTrendingProducts->count() > 0 || collect($trendingProductsByCategory)->flatten()->count() > 0)
                    <div class="tab-content">
                        <!-- All Trending Products Tab -->
                        <div class="tab-pane active show" id="all-genres" role="tabpanel">
                            <div class="grid-layout" data-grid="grid-6">
                                @forelse($allTrendingProducts as $product)
                                    @include('frontend.v1.partials.product_card', ['product' => $product])
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <p class="text-muted">No trending products found.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Category Trending Tabs -->
                        @foreach ($categoriesForTabs as $category)
                            @php
                                $categorySlug = \Illuminate\Support\Str::slug($category->title);
                                $categoryProducts = $trendingProductsByCategory[$category->title] ?? collect();
                            @endphp
                            @if ($categoryProducts->count() > 0)
                                <div class="tab-pane" id="{{ $categorySlug }}" role="tabpanel">
                                    <div class="grid-layout" data-grid="grid-6">
                                        @foreach ($categoryProducts as $product)
                                            @include('frontend.v1.partials.product_card', [
                                                'product' => $product,
                                            ])
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info mt-3">
                        <p class="mb-0">No trending products available at the moment.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- /tab -->

    <!-- New Products Section -->
    <section class="flat-spacing-12 mt-5">
        <div class="container">
            <div class="flat-animate-tab">
                <div class="flat-title flex-row justify-content-between align-items-center px-0 flex-wrap wow fadeInUp"
                    data-wow-delay="0s">
                    <h3 class="title font-libre-baskerville fw-7 text-primary">New Arrivals</h3>
                    @if ($categoriesForTabs->count() > 0)
                        <ul class="widget-tab-5 d-flex wow fadeInUp mb-0" data-wow-delay="0s" role="tablist">
                            <li class="nav-tab-item" role="presentation">
                                <a href="#all-new" class="active fw-6 rounded-0 bg-primary text-white"
                                    data-bs-toggle="tab">
                                    All New Arrivals ({{ $allNewProducts->count() }})
                                </a>
                            </li>
                            @foreach ($categoriesForTabs as $category)
                                @php
                                    $categoryProductCount = isset($newProductsByCategory[$category->title])
                                        ? $newProductsByCategory[$category->title]->count()
                                        : 0;
                                @endphp
                                @if ($categoryProductCount > 0)
                                    <li class="nav-tab-item" role="presentation">
                                        <a href="#new-{{ \Illuminate\Support\Str::slug($category->title) }}"
                                            class="fw-6 rounded-0" data-bs-toggle="tab">
                                            {{ $category->title }} ({{ $categoryProductCount }})
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>

                @if ($allNewProducts->count() > 0 || collect($newProductsByCategory)->flatten()->count() > 0)
                    <div class="tab-content">
                        <!-- All New Products Tab -->
                        <div class="tab-pane active show" id="all-new" role="tabpanel">
                            <div class="grid-layout" data-grid="grid-6">
                                @forelse($allNewProducts as $product)
                                    @include('frontend.v1.partials.product_card', ['product' => $product])
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <p class="text-muted">No new products found.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Category New Products Tabs -->
                        @foreach ($categoriesForTabs as $category)
                            @php
                                $categorySlug = \Illuminate\Support\Str::slug($category->title);
                                $categoryProducts = $newProductsByCategory[$category->title] ?? collect();
                            @endphp
                            @if ($categoryProducts->count() > 0)
                                <div class="tab-pane" id="new-{{ $categorySlug }}" role="tabpanel">
                                    <div class="grid-layout" data-grid="grid-6">
                                        @foreach ($categoryProducts as $product)
                                            @include('frontend.v1.partials.product_card', [
                                                'product' => $product,
                                            ])
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info mt-3">
                        <p class="mb-0">No new arrivals available at the moment.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Default Products Section -->
    <section class="flat-spacing-12 mt-5 bg-light py-4 rounded">
        <div class="container">
            <div class="flat-animate-tab">
                <div class="flat-title flex-row justify-content-between align-items-center px-0 flex-wrap wow fadeInUp"
                    data-wow-delay="0s">
                    <h3 class="title font-libre-baskerville fw-7 text-success">Regular Products</h3>
                    @if ($categoriesForTabs->count() > 0)
                        <ul class="widget-tab-5 d-flex wow fadeInUp mb-0" data-wow-delay="0s" role="tablist">
                            <li class="nav-tab-item" role="presentation">
                                <a href="#all-default" class="active fw-6 rounded-0 bg-success text-white"
                                    data-bs-toggle="tab">
                                    All Regular Products ({{ $allDefaultProducts->count() }})
                                </a>
                            </li>
                            @foreach ($categoriesForTabs as $category)
                                @php
                                    $categoryProductCount = isset($defaultProductsByCategory[$category->title])
                                        ? $defaultProductsByCategory[$category->title]->count()
                                        : 0;
                                @endphp
                                @if ($categoryProductCount > 0)
                                    <li class="nav-tab-item" role="presentation">
                                        <a href="#default-{{ \Illuminate\Support\Str::slug($category->title) }}"
                                            class="fw-6 rounded-0" data-bs-toggle="tab">
                                            {{ $category->title }} ({{ $categoryProductCount }})
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>

                @if ($allDefaultProducts->count() > 0 || collect($defaultProductsByCategory)->flatten()->count() > 0)
                    <div class="tab-content">
                        <!-- All Default Products Tab -->
                        <div class="tab-pane active show" id="all-default" role="tabpanel">
                            <div class="grid-layout" data-grid="grid-6">
                                @forelse($allDefaultProducts as $product)
                                    @include('frontend.v1.partials.product_card', ['product' => $product])
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <p class="text-muted">No regular products found.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Category Default Products Tabs -->
                        @foreach ($categoriesForTabs as $category)
                            @php
                                $categorySlug = \Illuminate\Support\Str::slug($category->title);
                                $categoryProducts = $defaultProductsByCategory[$category->title] ?? collect();
                            @endphp
                            @if ($categoryProducts->count() > 0)
                                <div class="tab-pane" id="default-{{ $categorySlug }}" role="tabpanel">
                                    <div class="grid-layout" data-grid="grid-6">
                                        @foreach ($categoryProducts as $product)
                                            @include('frontend.v1.partials.product_card', [
                                                'product' => $product,
                                            ])
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info mt-3">
                        <p class="mb-0">No regular products available at the moment.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Banner Collection -->
    <section class="">
        <div class="container hover-img">
            <div class="tf-banner-collection img-style radius-20">
                <img class="lazyload" data-src={{ asset('frontend/asset/images/collections/cls-book-store-7.jpg') }}
                    src={{ asset('frontend/asset/images/collections/cls-book-store-7.jpg') }} alt="img-banner"
                    loading="lazy">
                <div class="box-content">
                    <div class="container wow fadeInUp" data-wow-delay="0s">
                        <div class="sub fw-7 text_black-2">SALE UP TO 30% OFF TODAY</div>
                        <h2 class="heading fw-6 font-libre-baskerville">Scary-good picks <br> For halloween</h2>
                        <p class="text_black-2 ">Scary good picks for Halloween</p>
                        <a href="shop-default.html"
                            class="radius-3 tf-btn btn-md btn-fill btn-icon animate-hover-btn"><span>Shop
                                Collection</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Banner Collection -->

    <!-- Best seller -->
    <section class="flat-spacing-15 line">
        <div class="container">
            <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                <span class="title font-libre-baskerville fw-7">Best Seller</span>
            </div>
            <div class="hover-sw-nav hover-sw-3">
                <div dir="ltr" class="swiper tf-sw-product-sell wrap-sw-over" data-preview="6" data-tablet="3"
                    data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3"
                    data-pagination-lg="3">
                    <div class="swiper-wrapper">
                        @foreach ($allProducts as $row)
                            <div class="swiper-slide">
                                <div class="card-product none-hover">
                                    <div class="card-product-wrapper">
                                        <a href="product-detail.html" class="product-img">
                                            <img class="lazyload img-product" data-src={{ asset($row->photo) }}
                                                src={{ asset($row->photo) }} alt="image-product">
                                        </a>
                                        <div class="list-product-btn absolute-2">
                                            <a href="#quick_add" data-bs-toggle="modal"
                                                class="box-icon bg_white quick-add tf-btn-loading">
                                                <span class="icon icon-bag"></span>
                                                <span class="tooltip">Quick Add</span>
                                            </a>
                                            <a href="#" class="box-icon bg_white wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                                <span class="icon icon-delete"></span>
                                            </a>
                                            <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft"
                                                class="box-icon bg_white compare btn-icon-action">
                                                <span class="icon icon-compare"></span>
                                                <span class="tooltip">Add to Compare</span>
                                                <span class="icon icon-check"></span>
                                            </a>
                                            <a href="#quick_view" data-bs-toggle="modal"
                                                class="box-icon bg_white quickview tf-btn-loading">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-product-info">
                                        <a href="#" class="link text_black-2">By {{ $row->brand_name }}</a>
                                        <a href="product-detail.html" class="title link">{{ $row->title }}</a>
                                        <span class="price">${{ $row->price }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Best seller -->

    <!-- Testimonial -->
    <section class="flat-spacing-18">
        <div class="container">
            <div class="flat-title title-lg wow fadeInUp" data-wow-delay="0s">
                <span class="title font-libre-baskerville fw-7">Customer Reviews</span>
            </div>
            <div class="wrap-carousel">
                <div dir="ltr" class="swiper tf-sw-testimonial" data-preview="3" data-tablet="2" data-mobile="1"
                    data-space-lg="30" data-space-md="15">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonial-item bg_white style-column wow fadeInUp" data-wow-delay="0s">
                                <div class="rating">
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </div>
                                <div class="heading">Great Value for the Quality</div>
                                <div class="text">
                                    “Reasonably priced for the quality, an excellent choice for anyone passionate
                                    about pickleball.”
                                </div>
                                <div class="author">
                                    <div class="name">Robert smith</div>
                                    <div class="metas">Customer from USA</div>
                                </div>
                                <div class="product">
                                    <div class="image">
                                        <a href="product-detail.html">
                                            <img class="lazyload"
                                                data-src={{ asset('frontend/asset/images/products/book-store-1.jpg') }}
                                                src={{ asset('frontend/asset/images/products/book-store-1.jpg') }}
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="content-wrap">
                                        <div class="product-title">
                                            <a href="product-detail.html">Burke Clete</a>
                                        </div>
                                        <div class="price fw-5 text_primary"><span class="old-price">$139.99</span>$105.95
                                        </div>
                                    </div>
                                    <a href="product-detail.html" class=""><i class="icon-arrow1-top-left"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-item bg_white style-column wow fadeInUp" data-wow-delay=".1s">
                                <div class="rating">
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </div>
                                <div class="heading">Lightweight and Precise</div>
                                <div class="text">
                                    “The paddle feels super lightweight and easy to control, allowing me to make
                                    more precise shots.”
                                </div>
                                <div class="author">
                                    <div class="name">Hellen Ase</div>
                                    <div class="metas">Customer from Japan</span></div>
                                </div>
                                <div class="product">
                                    <div class="image">
                                        <a href="product-detail.html">
                                            <img class="lazyload"
                                                data-src={{ asset('frontend/asset/images/products/book-store-2.jpg') }}
                                                src={{ asset('frontend/asset/images/products/pickleball-red-2.jpg') }}
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="content-wrap">
                                        <div class="product-title">
                                            <a href="product-detail.html" class="text-line-clamp-1">Funny a noval
                                                Story</a>
                                        </div>
                                        <div class="price">$249.99</div>
                                    </div>
                                    <a href="product-detail.html" class=""><i class="icon-arrow1-top-left"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-item bg_white style-column wow fadeInUp" data-wow-delay=".2s">
                                <div class="rating">
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </div>
                                <div class="heading">Built to Last</div>
                                <div class="text">
                                    “Durable design and high-quality materials, great for both beginners and
                                    seasoned players.”
                                </div>
                                <div class="author">
                                    <div class="name">Peter Rope</div>
                                    <div class="metas">Customer from USA</div>
                                </div>
                                <div class="product">
                                    <div class="image">
                                        <a href="product-detail.html">
                                            <img class="lazyload"
                                                data-src={{ asset('frontend/asset/images/products/book-store-3.jpg') }}
                                                src={{ asset('frontend/asset/images/products/book-store-3.jpg') }}
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="content-wrap">
                                        <div class="product-title">
                                            <a href="product-detail.html" class="text-line-clamp-1">Everytime
                                                Vacation Some</a>
                                        </div>
                                        <div class="price">From $18.95</div>
                                    </div>
                                    <a href="product-detail.html" class=""><i class="icon-arrow1-top-left"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-item bg_white style-column wow fadeInUp" data-wow-delay=".3s">
                                <div class="rating">
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </div>
                                <div class="heading">Comfortable Grip for Long Play</div>
                                <div class="text">
                                    “The grip is soft and comfortable, no hand strain even after long play
                                    sessions.”
                                </div>
                                <div class="author">
                                    <div class="name">Allen Lyn</div>
                                    <div class="metas">Customer from France</div>
                                </div>
                                <div class="product">
                                    <div class="image">
                                        <a href="product-detail.html">
                                            <img class="lazyload"
                                                data-src={{ asset('frontend/asset/images/products/book-store-4.jpg') }}
                                                src={{ asset('frontend/asset/images/products/book-store-4.jpg') }}
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="content-wrap">
                                        <div class="product-title">
                                            <a href="product-detail.html" class="text-line-clamp-1">Gearbox Pro
                                                Power Elongated Pickleball Paddle</a>
                                        </div>
                                        <div class="price">$274.99</div>
                                    </div>
                                    <a href="product-detail.html" class=""><i class="icon-arrow1-top-left"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nav-sw disable-line style-white nav-next-slider nav-next-testimonial lg border"><span
                        class="icon icon-arrow-left"></span></div>
                <div class="nav-sw disable-line style-white nav-prev-slider nav-prev-testimonial lg border"><span
                        class="icon icon-arrow-right"></span></div>
                <div class="sw-dots style-2 sw-pagination-testimonial justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /Testimonial -->

    <!-- Store -->
    <section class="flat-spacing-9 pt_0">
        <div class="container">
            <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                <span class="title fw-7 font-libre-baskerville">Visit our store</span>
            </div>
            <div class="flat-tab-store flat-animate-tab">
                <ul class="widget-tab-2" role="tablist">
                    <li class="nav-tab-item" role="presentation">
                        <a href="#hongkong" class="active" data-bs-toggle="tab">Hongkong</a>
                    </li>
                    <li class="nav-tab-item" role="presentation">
                        <a href="#london" data-bs-toggle="tab">London</a>
                    </li>
                    <li class="nav-tab-item" role="presentation">
                        <a href="#paris" data-bs-toggle="tab">Paris</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active show" id="hongkong" role="tabpanel">
                        <div class="widget-card-store align-items-center tf-grid-layout md-col-2">
                            <div class="store-item-info">
                                <h5 class="store-heading">Hongkong Store</h5>
                                <div class="description">
                                    <p>301 Front St WToronto,<br>Ecomus@support.com <br>(08) 8942 1299</p>
                                    <p>Mon - Fri, 8:30am - 10:30pm<br>Saturday, 8:30am - 10:30pm <br>Sunday Closed
                                    </p>
                                </div>
                            </div>
                            <div class="store-img">
                                <img class="lazyload"
                                    data-src={{ asset('frontend/asset/images/shop/store/ourstore7.jpg') }}
                                    src={{ asset('frontend/asset/images/shop/store/ourstore7.jpg') }} alt="store-img">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="london" role="tabpanel">
                        <div class="widget-card-store align-items-center tf-grid-layout md-col-2">
                            <div class="store-item-info">
                                <h5 class="store-heading">London Store</h5>
                                <div class="description">
                                    <p>301 Front St WToronto,<br>Ecomus@support.com <br>(08) 8942 1299</p>
                                    <p>Mon - Fri, 8:30am - 10:30pm<br>Saturday, 8:30am - 10:30pm <br>Sunday Closed
                                    </p>
                                </div>
                            </div>
                            <div class="store-img">
                                <img class="lazyload"
                                    data-src={{ asset('frontend/asset/images/shop/store/ourstore8.jpg') }}
                                    src={{ asset('frontend/asset/images/shop/store/ourstore8.jpg') }} alt="store-img">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="paris" role="tabpanel">
                        <div class="widget-card-store align-items-center tf-grid-layout md-col-2">
                            <div class="store-item-info">
                                <h5 class="store-heading">Paris Store</h5>
                                <div class="description">
                                    <p>301 Front St WToronto,<br>Ecomus@support.com <br>(08) 8942 1299</p>
                                    <p>Mon - Fri, 8:30am - 10:30pm<br>Saturday, 8:30am - 10:30pm <br>Sunday Closed
                                    </p>
                                </div>
                            </div>
                            <div class="store-img">
                                <img class="lazyload"
                                    data-src={{ asset('frontend/asset/images/shop/store/ourstore9.jpg') }}
                                    src={{ asset('frontend/asset/images/shop/store/ourstore9.jpg') }} alt="store-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Store -->

    <!-- Icon box -->
    <section class="flat-spacing-3 flat-iconbox bg_f3f4f7">
        <div class="container">
            <div class="wrap-carousel wrap-mobile">
                <div dir="ltr" class="swiper tf-sw-mobile" data-preview="1" data-space="15">
                    <div class="swiper-wrapper wrap-iconbox">
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-row">
                                <div class="icon bg_white">
                                    <i class="icon-shipping"></i>
                                </div>
                                <div class="content">
                                    <div class="title fw-5">Free Shipping</div>
                                    <p class="text_black-2">Free shipping over order $120</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-row">
                                <div class="icon bg_white">
                                    <i class="icon-payment fs-22"></i>
                                </div>
                                <div class="content">
                                    <div class="title fw-5">Flexible Payment</div>
                                    <p class="text_black-2">Pay with Multiple Credit Cards</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-row">
                                <div class="icon bg_white">
                                    <i class="icon-return fs-20"></i>
                                </div>
                                <div class="content">
                                    <div class="title fw-5">14 Day Returns</div>
                                    <p class="text_black-2">Within 30 days for an exchange</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-row">
                                <div class="icon bg_white">
                                    <i class="icon-suport"></i>
                                </div>
                                <div class="content">
                                    <div class="title fw-5">Premium Support</div>
                                    <p class="text_black-2">Outstanding premium support</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="sw-dots style-2 sw-pagination-mb justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /Icon box -->

@endsection
