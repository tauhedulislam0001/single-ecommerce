@extends('frontend.v1.layouts.master')

@section('title', 'E-SHOP || PRODUCT PAGE')

@section('main-content')

    <!-- page-title -->
    <div class="tf-page-title">
        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    @php
                        // Determine page title
                        $pageTitle = match (true) {
                            isset($category) && $category => $category->title,
                            isset($brand) && $brand => $brand->title,
                            request()->has('search') => 'Search Results',
                            request()->has('price') => 'Filtered Products',
                            default => 'All Products',
                        };

                        // Determine page description
                        $pageDescription = match (true) {
                            isset($category) && $category => $category->description ??
                                "Browse our {$category->title} collection",
                            isset($brand) && $brand => "Products from {$brand->title}",
                            request()->has('search') => 'Showing results for "' . request('search') . '"',
                            request()->has('price') => 'Products within price range: ' . request('price'),
                            default => 'Shop through our latest selection',
                        };
                    @endphp

                    <div class="heading text-center">{{ $pageTitle }}</div>
                    <p class="text-center text-2 text_black-2 mt_5">{{ $pageDescription }}</p>

                    @if ($productCount > 0)
                        <p class="text-center text-muted small mt-1">
                            {{ $productCount }} {{ Str::plural('item', $productCount) }} found
                        </p>
                    @endif

                    @if (request()->has('sortBy') && request('sortBy') != '')
                        <p class="text-center text-muted small mt-2">
                            Sorted by:
                            @switch(request('sortBy'))
                                @case('title')
                                    Name (A-Z)
                                @break

                                @case('price')
                                    Price (Low to High)
                                @break

                                @case('category')
                                    Category
                                @break

                                @case('brand')
                                    Brand
                                @break

                                @default
                                    Featured
                            @endswitch
                        </p>
                    @endif
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
                    <li class="tf-view-layout-switch sw-layout-2" data-value-layout="tf-col-2">
                        <div class="item"><span class="icon icon-grid-2"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-3 active" data-value-layout="tf-col-3">
                        <div class="item"><span class="icon icon-grid-3"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-4" data-value-layout="tf-col-4">
                        <div class="item"><span class="icon icon-grid-4"></span></div>
                    </li>
                </ul>
                <div class="tf-control-sorting d-flex justify-content-end">
                    <form action="{{ route('shop.filter.v1') }}" method="POST" id="sortForm">
                        @csrf
                        <select class="form-select" name="sortBy" onchange="this.form.submit();" style="width: 200px;">
                            <option value="">Sort By: Featured</option>
                            <option value="title" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'title') selected @endif>Name (A-Z)</option>
                            <option value="price" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'price') selected @endif>Price (Low to High)
                            </option>
                            <option value="category" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'category') selected @endif>Category</option>
                            <option value="brand" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'brand') selected @endif>Brand</option>
                        </select>
                        <input type="hidden" name="price_range"
                            value="@if (!empty($_GET['price'])) {{ $_GET['price'] }} @endif">
                        <input type="hidden" name="show"
                            value="@if (!empty($_GET['show'])) {{ $_GET['show'] }} @endif">
                    </form>
                </div>
            </div>
            <div class="tf-row-flex">
                <div class="tf-shop-sidebar sidebar-filter canvas-filter left">
                    <div class="canvas-wrapper">
                        <div class="canvas-header d-flex d-xl-none">
                            <div class="filter-icon">
                                <span class="icon icon-filter"></span>
                                <span>Filter</span>
                            </div>
                            <span class="icon-close icon-close-popup close-filter"></span>
                        </div>
                        <div class="canvas-body">
                            <div class="widget-facet wd-categories">
                                <div class="facet-title" data-bs-target="#categories" data-bs-toggle="collapse"
                                    aria-expanded="true" aria-controls="categories">
                                    <span>Product categories</span>
                                    <span class="icon icon-arrow-up"></span>
                                </div>
                                <div id="categories" class="collapse show">
                                    <ul class="list-categoris current-scrollbar mb_36">
                                        @php
                                            $menu = App\Models\Category::getAllParentWithChild();
                                        @endphp
                                        @if ($menu)
                                            @foreach ($menu as $cat_info)
                                                @if ($cat_info->child_cat->count() > 0)
                                                    <li class="cate-item">
                                                        <a href="{{ route('product-cat.v1', $cat_info->slug) }}">
                                                            <span>{{ $cat_info->title }}</span>
                                                        </a>
                                                        <ul style="padding-left: 15px;">
                                                            @foreach ($cat_info->child_cat as $sub_menu)
                                                                <li class="cate-item">
                                                                    <a
                                                                        href="{{ route('product-sub-cat.v1', [$cat_info->slug, $sub_menu->slug]) }}">
                                                                        <span>{{ $sub_menu->title }}</span>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li class="cate-item">
                                                        <a href="{{ route('product-cat.v1', $cat_info->slug) }}">
                                                            <span>{{ $cat_info->title }}</span>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <form action="#" id="facet-filter-form" class="facet-filter-form">
                                <div class="widget-facet wrap-price">
                                    <form action="{{ route('shop.filter') }}" method="POST" id="priceFilterForm">
                                        @csrf
                                        <div class="facet-title" data-bs-target="#price" data-bs-toggle="collapse"
                                            aria-expanded="true" aria-controls="price">
                                            <span>Price</span>
                                            <span class="icon icon-arrow-up"></span>
                                        </div>
                                        <div id="price" class="collapse show">
                                            <div class="widget-price filter-price">
                                                @php
                                                    $max =
                                                        DB::table('products')
                                                            ->where('status', 'active')
                                                            ->max('price') ?? 1000;
                                                    $min =
                                                        DB::table('products')
                                                            ->where('status', 'active')
                                                            ->min('price') ?? 0;
                                                    $current_price = !empty($_GET['price'])
                                                        ? $_GET['price']
                                                        : $min . '-' . $max;
                                                    $prices = explode('-', $current_price);
                                                    $current_min = isset($prices[0]) ? (float) $prices[0] : $min;
                                                    $current_max = isset($prices[1]) ? (float) $prices[1] : $max;
                                                @endphp

                                                <!-- Price range slider -->
                                                <div class="price-val-range" id="price-value-range"
                                                    data-min="{{ $min }}" data-max="{{ $max }}"
                                                    data-current-min="{{ $current_min }}"
                                                    data-current-max="{{ $current_max }}">
                                                </div>

                                                <div class="box-title-price">
                                                    <span class="title-price">Price :</span>
                                                    <div class="caption-price">
                                                        <div class="price-val" id="price-min-value" data-currency="$">
                                                            ${{ number_format($current_min, 0) }}
                                                        </div>
                                                        <span>-</span>
                                                        <div class="price-val" id="price-max-value" data-currency="$">
                                                            ${{ number_format($current_max, 0) }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Hidden inputs for form submission -->
                                                <input type="hidden" name="price_range" id="price_range"
                                                    value="{{ $current_price }}" />
                                                <input type="hidden" name="sortBy"
                                                    value="@if (!empty($_GET['sortBy'])) {{ $_GET['sortBy'] }} @endif">
                                                <input type="hidden" name="show"
                                                    value="@if (!empty($_GET['show'])) {{ $_GET['show'] }} @endif">

                                                <!-- Submit button -->
                                                <button type="submit" class="btn btn-primary w-100 mt-3"
                                                    style="display: none;" id="applyPriceFilter">
                                                    Apply Price Filter
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="widget-facet">
                                    <div class="facet-title" data-bs-target="#brand" data-bs-toggle="collapse"
                                        aria-expanded="true" aria-controls="brand">
                                        <span>Brand</span>
                                        <span class="icon icon-arrow-up"></span>
                                    </div>
                                    <div id="brand" class="collapse show">
                                        <ul class="tf-filter-group current-scrollbar mb_36">
                                            @php
                                                $brands = DB::table('brands')
                                                    ->orderBy('title', 'ASC')
                                                    ->where('status', 'active')
                                                    ->get();
                                            @endphp
                                            @foreach ($brands as $brand)
                                                <li class="cate-item">
                                                    <a href="{{ route('product-brand.v1', $brand->slug) }}">
                                                        <span>{{ $brand->title }}</span>
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
                                            @foreach ($recent_products as $product)
                                                @php
                                                    $photo = explode(',', $product->photo);
                                                    $org =
                                                        $product->price - ($product->price * $product->discount) / 100;
                                                @endphp
                                                <div class="d-flex gap-2 mb-3">
                                                    <div class="img-style">
                                                        <img src="{{ $photo[0] }}" alt="{{ $product->title }}"
                                                            style="width: 80px; height: 80px; object-fit: cover;">
                                                    </div>
                                                    <div class="content">
                                                        <a href="{{ route('product-detail.v1', $product->slug) }}"
                                                            class="link">{{ Str::limit($product->title, 30) }}</a>
                                                        <p class="price mb-0">
                                                            @if ($product->discount > 0)
                                                                <del
                                                                    class="text-muted small">${{ number_format($product->price, 2) }}</del>
                                                            @endif
                                                            <span class="fw-bold">${{ number_format($org, 2) }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="tf-shop-content wrapper-control-shop">
                    <div class="meta-filter-shop">
                        <div id="product-count-grid" class="count-text"></div>
                        <div id="product-count-list" class="count-text"></div>
                        <div id="applied-filters"></div>
                        <button id="remove-all" class="remove-all-filters" style="display: none;">Remove All <i
                                class="icon icon-close"></i></button>
                    </div>

                    <!-- Grid Layout (3 columns) -->
                    <div class="tf-grid-layout wrapper-shop tf-col-3" id="gridLayout">
                        @if (count($products))
                            @foreach ($products as $product)
                                @php
                                    $photo = explode(',', $product->photo);
                                    $after_discount = $product->price - ($product->price * $product->discount) / 100;
                                @endphp
                                <div class="card-product grid" data-availability="In stock" data-brand="Ecomus">
                                    <div class="card-product-wrapper">
                                        <!-- Whole product card is clickable -->
                                        <a href="{{ route('product-detail.v1', $product->slug) }}" class="product-img"
                                            style="display: block;">
                                            <img class="lazyload img-product" data-src="{{ $photo[0] }}"
                                                src="{{ $photo[0] }}" alt="{{ $product->title }}">
                                            @if (isset($photo[1]))
                                                <img class="lazyload img-hover" data-src="{{ $photo[1] }}"
                                                    src="{{ $photo[1] }}" alt="{{ $product->title }}">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="card-product-info">
                                        <a href="{{ route('product-detail.v1', $product->slug) }}"
                                            class="title link">{{ $product->title }}</a>
                                        <span class="price">
                                            @if ($product->discount > 0)
                                                <span class="old-price">${{ number_format($product->price, 2) }}</span>
                                            @endif
                                            <span class="new-price">${{ number_format($after_discount, 2) }}</span>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <h4 class="text-warning text-center" style="margin:100px auto;">There are no products.
                                </h4>
                            </div>
                        @endif
                    </div>

                    <!-- Pagination -->
                    @if (count($products) && method_exists($products, 'links'))
                        <ul class="tf-pagination-list tf-pagination-wrap mt-4">
                            {{ $products->appends($_GET)->links() }}
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Make entire product card clickable */
        .card-product {
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 2px solid transparent;
            border-radius: 8px;
            overflow: hidden;
        }

        .card-product:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 2px solid #007bff;
        }

        .card-product-wrapper {
            flex: 1;
            position: relative;
            overflow: hidden;
        }

        .product-img {
            display: block;
            position: relative;
            overflow: hidden;
            height: 250px;
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        /* REMOVE or FIX this problematic rule that makes image disappear */
        /* .product-img:hover .img-product {
                opacity: 0;
            } */

        /* Keep the image always visible */
        .img-product {
            opacity: 1 !important;
            /* Force opacity to always be 1 */
            position: relative;
            z-index: 1;
        }

        .img-hover {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;
            z-index: 2;
        }

        /* Only show hover image on top of main image (optional) */
        .product-img:hover .img-hover {
            opacity: 1;
        }

        /* Keep the main image visible underneath */
        .product-img:hover .img-product {
            opacity: 1 !important;
            /* Keep main image visible */
        }

        .card-product-info {
            padding: 15px;
            background: white;
            border-top: none;
        }

        .card-product-info .title {
            display: block;
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .card-product-info .title:hover {
            color: #007bff;
        }

        .price {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
        }

        .old-price {
            font-size: 14px;
            color: #999;
            text-decoration: line-through;
        }

        .new-price {
            font-size: 18px;
            color: #e74c3c;
        }

        /* If you don't want hover image at all, use this simpler version */
        .card-product.simple-version .img-hover {
            display: none;
            /* Hide hover image completely */
        }

        .card-product.simple-version:hover .img-product {
            transform: scale(1.05);
        }

        /* Pagination Styles */
        .tf-pagination-list {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 20px 0;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .tf-pagination-list li {
            margin: 5px;
        }

        .tf-pagination-list li a,
        .tf-pagination-list li span {
            display: inline-block;
            padding: 8px 16px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            text-decoration: none;
            color: #007bff;
            transition: all 0.3s ease;
        }

        .tf-pagination-list li a:hover {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .tf-pagination-list li.active span {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .tf-pagination-list li.disabled span {
            color: #6c757d;
            background-color: #f8f9fa;
            border-color: #dee2e6;
            cursor: not-allowed;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .product-img {
                height: 200px;
            }

            .card-product-info .title {
                font-size: 15px;
            }

            .new-price {
                font-size: 16px;
            }

            .tf-pagination-list li {
                margin: 3px;
            }

            .tf-pagination-list li a,
            .tf-pagination-list li span {
                padding: 6px 12px;
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            .product-img {
                height: 180px;
            }

            .tf-pagination-list {
                flex-wrap: wrap;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Product page loaded');

            // Make entire product card clickable
            document.querySelectorAll('.card-product').forEach(card => {
                card.addEventListener('click', function(e) {
                    // Don't trigger if clicking on a link inside
                    if (e.target.tagName === 'A' || e.target.closest('a')) {
                        return;
                    }

                    // Find the product link inside the card
                    const productLink = this.querySelector('a[href*="product-detail"]');
                    if (productLink) {
                        window.location.href = productLink.href;
                    }
                });
            });

            // Add hover effect for product images - UPDATED
            document.querySelectorAll('.product-img').forEach(img => {
                const mainImg = img.querySelector('.img-product');
                const hoverImg = img.querySelector('.img-hover');

                if (mainImg && hoverImg) {
                    // Initialize hover image position
                    hoverImg.style.position = 'absolute';
                    hoverImg.style.top = '0';
                    hoverImg.style.left = '0';
                    hoverImg.style.width = '100%';
                    hoverImg.style.height = '100%';
                    hoverImg.style.objectFit = 'cover';

                    // Set initial opacity
                    mainImg.style.opacity = '1';
                    hoverImg.style.opacity = '0';

                    // CSS transitions are handled by CSS now
                }
            });

            // Optional: Add class to cards for simple hover effect (without image fade)
            // Uncomment if you want just border change without image fade
            // document.querySelectorAll('.card-product').forEach(card => {
            //     card.classList.add('simple-hover');
            // });
        });
    </script>
@endpush
