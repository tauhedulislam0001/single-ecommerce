@extends('frontend.v1.layouts.master')

@section('title','E-SHOP || PRODUCT PAGE')

@section('main-content')

<!-- page-title -->
<div class="tf-page-title">
    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <div class="heading text-center">All Product List</div>
                <p class="text-center text-2 text_black-2 mt_5">Shop through our latest selection of Fashion</p>
            </div>
        </div>
    </div>
</div>
<!-- /page-title -->

<section class="flat-spacing-1">
    <div class="container">
        <div class="tf-shop-control grid-3 align-items-center">
            <div></div>
            <ul class="tf-control-layout d-flex justify-content-center">
                <li class="tf-view-layout-switch sw-layout-list list-layout" data-value-layout="list">
                    <div class="item"><span class="icon icon-list"></span></div>
                </li>
                <li class="tf-view-layout-switch sw-layout-2" data-value-layout="grid-2">
                    <div class="item"><span class="icon icon-grid-2"></span></div>
                </li>
                <li class="tf-view-layout-switch sw-layout-3 active" data-value-layout="grid-3">
                    <div class="item"><span class="icon icon-grid-3"></span></div>
                </li>
                <li class="tf-view-layout-switch sw-layout-4" data-value-layout="grid-4">
                    <div class="item"><span class="icon icon-grid-4"></span></div>
                </li>
            </ul>
            <div class="tf-control-sorting d-flex justify-content-end">
                <form action="{{route('shop.filter')}}" method="POST" id="sortForm">
                    @csrf
                    <select class="form-select" name="sortBy" onchange="this.form.submit();" style="width: 200px;">
                        <option value="">Sort By: Featured</option>
                        <option value="title" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='title') selected @endif>Name (A-Z)</option>
                        <option value="price" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='price') selected @endif>Price (Low to High)</option>
                        <option value="category" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='category') selected @endif>Category</option>
                        <option value="brand" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='brand') selected @endif>Brand</option>
                    </select>
                    <input type="hidden" name="price_range" value="@if(!empty($_GET['price'])){{$_GET['price']}}@endif">
                    <input type="hidden" name="show" value="@if(!empty($_GET['show'])){{$_GET['show']}}@endif">
                </form>
            </div>
        </div>

        <div class="tf-row-flex">
            <!-- Sidebar Filter -->
            <div class="tf-shop-sidebar wrap-sidebar-mobile">
                <div class="widget-facet wd-categories">
                    <div class="facet-title" data-bs-target="#categories" data-bs-toggle="collapse"
                        aria-expanded="true" aria-controls="categories">
                        <span>Product categories</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="categories" class="collapse show">
                        <ul class="list-categoris current-scrollbar mb_36">
                            @php
                                $menu=App\Models\Category::getAllParentWithChild();
                            @endphp
                            @if($menu)
                                @foreach($menu as $cat_info)
                                    @if($cat_info->child_cat->count()>0)
                                        <li class="cate-item">
                                            <a href="{{route('product-cat',$cat_info->slug)}}">
                                                <span>{{$cat_info->title}}</span>
                                            </a>
                                            <ul style="padding-left: 15px;">
                                                @foreach($cat_info->child_cat as $sub_menu)
                                                    <li class="cate-item">
                                                        <a href="{{route('product-sub-cat',[$cat_info->slug,$sub_menu->slug])}}">
                                                            <span>{{$sub_menu->title}}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li class="cate-item">
                                            <a href="{{route('product-cat',$cat_info->slug)}}">
                                                <span>{{$cat_info->title}}</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Price Filter -->
                <form action="{{route('shop.filter')}}" method="POST" id="priceFilterForm">
                    @csrf
                    <div class="widget-facet wrap-price">
                        <div class="facet-title" data-bs-target="#price" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="price">
                            <span>Shop by Price</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="price" class="collapse show">
                            <div class="widget-price filter-price p-3">
                                @php
                                    $max=DB::table('products')->max('price') ?? 1000;
                                    $min=DB::table('products')->min('price') ?? 0;
                                @endphp

                                <div id="slider-range" class="mb-3"></div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <label class="small">Price Range:</label>
                                        <div class="price-display">
                                            <span id="amount"></span>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="price_range" id="price_range" value="@if(!empty($_GET['price'])){{$_GET['price']}}@else{{$min}}-{{$max}}@endif"/>
                                <input type="hidden" name="sortBy" value="@if(!empty($_GET['sortBy'])){{$_GET['sortBy']}}@endif">
                                <input type="hidden" name="show" value="@if(!empty($_GET['show'])){{$_GET['show']}}@endif">

                                <button type="submit" class="btn btn-primary w-100 mt-3">Apply Filter</button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Brand Filter -->
                <div class="widget-facet">
                    <div class="facet-title" data-bs-target="#brand" data-bs-toggle="collapse"
                        aria-expanded="true" aria-controls="brand">
                        <span>Brands</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="brand" class="collapse show">
                        <ul class="list-categoris current-scrollbar mb_36">
                            @php
                                $brands=DB::table('brands')->orderBy('title','ASC')->where('status','active')->get();
                            @endphp
                            @foreach($brands as $brand)
                                <li class="cate-item">
                                    <a href="{{route('product-brand',$brand->slug)}}">
                                        <span>{{$brand->title}}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Recent Products -->
                <div class="widget-facet">
                    <div class="facet-title" data-bs-target="#recent" data-bs-toggle="collapse"
                        aria-expanded="true" aria-controls="recent">
                        <span>Recent Products</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="recent" class="collapse show">
                        <div class="current-scrollbar mb_36">
                            @foreach($recent_products as $product)
                                @php
                                    $photo=explode(',',$product->photo);
                                    $org=($product->price-($product->price*$product->discount)/100);
                                @endphp
                                <div class="d-flex gap-2 mb-3">
                                    <div class="img-style">
                                        <img src="{{$photo[0]}}" alt="{{$product->title}}" style="width: 80px; height: 80px; object-fit: cover;">
                                    </div>
                                    <div class="content">
                                        <a href="{{route('product-detail',$product->slug)}}" class="link">{{Str::limit($product->title, 30)}}</a>
                                        <p class="price mb-0">
                                            @if($product->discount > 0)
                                                <del class="text-muted small">${{number_format($product->price,2)}}</del>
                                            @endif
                                            <span class="fw-bold">${{number_format($org,2)}}</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="tf-shop-content">
                <div class="grid-layout wrapper-shop" data-grid="grid-3">
                    @if(count($products))
                        @foreach($products as $product)
                            @php
                                $photo=explode(',',$product->photo);
                                $after_discount=($product->price-($product->price*$product->discount)/100);
                            @endphp
                            <div class="card-product">
                                <div class="card-product-wrapper">
                                    <a href="{{route('product-detail',$product->slug)}}" class="product-img">
                                        <img class="lazyload img-product" data-src="{{$photo[0]}}" src="{{$photo[0]}}" alt="{{$product->title}}">
                                        @if(isset($photo[1]))
                                            <img class="lazyload img-hover" data-src="{{$photo[1]}}" src="{{$photo[1]}}" alt="{{$product->title}}">
                                        @endif
                                    </a>
                                    <div class="list-product-btn">
                                        <a href="{{route('add-to-cart',$product->slug)}}" class="box-icon bg_white quick-add tf-btn-loading">
                                            <span class="icon icon-bag"></span>
                                            <span class="tooltip">Add to Cart</span>
                                        </a>
                                        <a href="{{route('add-to-wishlist',$product->slug)}}" class="box-icon bg_white wishlist btn-icon-action">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip">Add to Wishlist</span>
                                        </a>
                                        <a href="#quick_view_{{$product->id}}" data-bs-toggle="modal" class="box-icon bg_white quickview tf-btn-loading">
                                            <span class="icon icon-view"></span>
                                            <span class="tooltip">Quick View</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-product-info">
                                    <a href="{{route('product-detail',$product->slug)}}" class="title link">{{$product->title}}</a>
                                    <span class="price">
                                        @if($product->discount > 0)
                                            <span class="old-price">${{number_format($product->price,2)}}</span>
                                        @endif
                                        <span class="new-price">${{number_format($after_discount,2)}}</span>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <h4 class="text-warning text-center" style="margin:100px auto;">There are no products.</h4>
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                @if(count($products))
                    <ul class="tf-pagination-list tf-pagination-wrap mt-4">
                        {{$products->appends($_GET)->links()}}
                    </ul>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Quick View Modals -->
@if($products)
    @foreach($products as $product)
        <div class="modal fade" id="quick_view_{{$product->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{$product->title}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="product-gallery">
                                    @php
                                        $photo=explode(',',$product->photo);
                                    @endphp
                                    <div id="carousel{{$product->id}}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach($photo as $key => $data)
                                                <div class="carousel-item @if($key == 0) active @endif">
                                                    <img src="{{$data}}" class="d-block w-100" alt="{{$product->title}}">
                                                </div>
                                            @endforeach
                                        </div>
                                        @if(count($photo) > 1)
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{$product->id}}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carousel{{$product->id}}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="quickview-content p-4">
                                    <div class="quickview-ratting-review mb-3">
                                        <div class="quickview-ratting-wrap">
                                            <div class="quickview-ratting">
                                                @php
                                                    $rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
                                                    $rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
                                                @endphp
                                                @for($i=1; $i<=5; $i++)
                                                    @if($rate>=$i)
                                                        <i class="yellow fa fa-star"></i>
                                                    @else
                                                        <i class="fa fa-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <a href="#"> ({{$rate_count}} customer review)</a>
                                        </div>
                                        <div class="quickview-stock">
                                            @if($product->stock >0)
                                                <span class="badge bg-success"><i class="fa fa-check-circle-o"></i> {{$product->stock}} in stock</span>
                                            @else
                                                <span class="badge bg-danger"><i class="fa fa-times-circle-o"></i> Out of stock</span>
                                            @endif
                                        </div>
                                    </div>
                                    @php
                                        $after_discount=($product->price-($product->price*$product->discount)/100);
                                    @endphp
                                    <h3 class="mb-3">
                                        @if($product->discount > 0)
                                            <del class="text-muted">${{number_format($product->price,2)}}</del>
                                        @endif
                                        <span class="text-primary">${{number_format($after_discount,2)}}</span>
                                    </h3>
                                    <div class="quickview-peragraph mb-3">
                                        <p>{!! html_entity_decode($product->summary) !!}</p>
                                    </div>
                                    @if($product->size)
                                        <div class="size mb-3">
                                            <h5>Size</h5>
                                            <div class="d-flex gap-2">
                                                @php
                                                    $sizes=explode(',',$product->size);
                                                @endphp
                                                @foreach($sizes as $size)
                                                    <span class="badge bg-light text-dark border">{{$size}}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <form action="{{route('single-add-to-cart')}}" method="POST">
                                        @csrf
                                        <div class="quantity mb-3">
                                            <div class="input-group" style="width: 150px;">
                                                <button type="button" class="btn btn-outline-secondary btn-number" data-type="minus" data-field="quant[1]">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                                <input type="hidden" name="slug" value="{{$product->slug}}">
                                                <input type="text" name="quant[1]" class="form-control input-number text-center" value="1" min="1" max="1000">
                                                <button type="button" class="btn btn-outline-secondary btn-number" data-type="plus" data-field="quant[1]">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="add-to-cart d-flex gap-2">
                                            <button type="submit" class="btn btn-primary">Add to cart</button>
                                            <a href="{{route('add-to-wishlist',$product->slug)}}" class="btn btn-outline-danger"><i class="fa fa-heart"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

@endsection

@push('styles')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .tf-shop-sidebar {
        width: 100%;
        max-width: 300px;
        padding-right: 30px;
    }

    .widget-facet {
        margin-bottom: 30px;
        border-bottom: 1px solid #e5e5e5;
        padding-bottom: 20px;
    }

    .widget-facet:last-child {
        border-bottom: none;
    }

    .facet-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        margin-bottom: 15px;
        font-weight: 600;
        font-size: 16px;
    }

    .list-categoris {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .cate-item {
        margin-bottom: 10px;
    }

    .cate-item a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s;
    }

    .cate-item a:hover {
        color: #F7941D;
    }

    /* Price Slider Styles */
    #slider-range {
        height: 6px;
        background: #e5e5e5;
        border: none;
        border-radius: 3px;
        margin: 20px 0;
    }

    #slider-range .ui-slider-range {
        background: #F7941D;
        border-radius: 3px;
    }

    #slider-range .ui-slider-handle {
        width: 18px;
        height: 18px;
        background: #F7941D;
        border: 2px solid #fff;
        border-radius: 50%;
        cursor: pointer;
        outline: none;
        top: -6px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    #slider-range .ui-slider-handle:hover,
    #slider-range .ui-slider-handle:focus {
        background: #e08419;
    }

    .price-display {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-top: 5px;
    }

    .tf-row-flex {
        display: flex;
        gap: 30px;
    }

    .tf-shop-content {
        flex: 1;
    }

    .grid-layout {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    @media (max-width: 1200px) {
        .grid-layout {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .tf-row-flex {
            flex-direction: column;
        }

        .tf-shop-sidebar {
            max-width: 100%;
            padding-right: 0;
        }

        .grid-layout {
            grid-template-columns: repeat(1, 1fr);
        }
    }

    .card-product {
        position: relative;
    }

    .card-product-wrapper {
        position: relative;
        overflow: hidden;
        margin-bottom: 15px;
        border-radius: 8px;
    }

    .card-product-wrapper img {
        width: 100%;
        height: auto;
        transition: transform 0.3s;
    }

    .card-product-wrapper .img-hover {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .card-product:hover .img-hover {
        opacity: 1;
    }

    .list-product-btn {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .card-product:hover .list-product-btn {
        opacity: 1;
    }

    .box-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        text-decoration: none;
        color: #333;
    }

    .box-icon:hover {
        background: #F7941D;
        color: white;
    }

    .old-price {
        text-decoration: line-through;
        color: #999;
        margin-right: 10px;
        font-size: 14px;
    }

    .new-price {
        color: #F7941D;
        font-weight: bold;
        font-size: 18px;
    }

    .yellow {
        color: #ffc107;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(document).ready(function(){
        console.log('Document ready');

        // Price range slider
        if ($("#slider-range").length > 0) {
            @php
                $max = DB::table('products')->max('price') ?? 1000;
                $min = DB::table('products')->min('price') ?? 0;
            @endphp

            const max_value = {{$max}};
            const min_value = {{$min}};

            console.log('Max:', max_value, 'Min:', min_value);

            let price_range = min_value + '-' + max_value;

            if($("#price_range").val()){
                price_range = $("#price_range").val().trim();
            }

            let prices = price_range.split('-');
            let minPrice = parseInt(prices[0]) || min_value;
            let maxPrice = parseInt(prices[1]) || max_value;

            console.log('Initial prices:', minPrice, maxPrice);

            // Initialize slider
            $("#slider-range").slider({
                range: true,
                min: min_value,
                max: max_value,
                values: [minPrice, maxPrice],
                slide: function(event, ui) {
                    $("#amount").text("$" + ui.values[0] + " - $" + ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                    console.log('Slider values:', ui.values[0], ui.values[1]);
                }
            });

            // Set initial display
            $("#amount").text("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

            console.log('Slider initialized');
        } else {
            console.log('Slider element not found');
        }

        // Quantity buttons
        $('.btn-number').click(function(e){
            e.preventDefault();

            var type = $(this).attr('data-type');
            var input = $(this).closest('.input-group').find('input[type=text]');
            var currentVal = parseInt(input.val());

            if(!isNaN(currentVal)) {
                if(type == 'minus') {
                    if(currentVal > input.attr('min')) {
                        input.val(currentVal - 1);
                    }
                } else if(type == 'plus') {
                    if(currentVal < input.attr('max')) {
                        input.val(currentVal + 1);
                    }
                }
            } else {
                input.val(1);
            }
        });
    });
</script>
@endpush
