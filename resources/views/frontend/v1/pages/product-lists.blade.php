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

                        // Safely get product count
                        $productCount = 0;
                        if (isset($products)) {
                            try {
                                $productCount = $products->total();
                            } catch (Exception $e) {
                                $productCount = count($products);
                            }
                        }
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
                                                        <a href="{{ route('product-detail', $product->slug) }}"
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
                    <div class="tf-list-layout wrapper-shop" id="listLayout">
                        <!-- card product 1 -->
                        <div class="card-product list-layout" data-availability="In stock" data-brand="Ecomus">

                            @if (count($products))
                                @foreach ($products as $product)
                                    @php
                                        $photo = explode(',', $product->photo);
                                        $after_discount =
                                            $product->price - ($product->price * $product->discount) / 100;
                                    @endphp
                                    <div class="card-product-wrapper">
                                        <a href="{{ route('product-detail.v1', $product->slug) }}" class="product-img">
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
                                        <span class="price current-price">${{ number_format($after_discount, 2) }}</span>
                                        <p class="description">{{ $product->summery }}</p>
                                        @if ($product->size)
                                            @php
                                                // Convert size string to array and clean it up
                                                $sizes = array_map('trim', explode(',', $product->size));
                                                $sizes = array_filter($sizes); // Remove empty values
                                            @endphp

                                            @if (count($sizes) > 0)
                                                <div class="size-list">
                                                    @foreach ($sizes as $size)
                                                        <span class="size-item">{{ $size }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endif
                                        <div class="list-product-btn">
                                            <a href="{{ route('add-to-cart.v1', $product->slug) }}"
                                                class="box-icon bg_white quick-add tf-btn-loading">
                                                <span class="icon icon-bag"></span>
                                                <span class="tooltip">Add to Cart</span>
                                            </a>
                                            <a href="{{ route('add-to-wishlist.v1', $product->slug) }}"
                                                class="box-icon bg_white wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                            </a>
                                            <a href="#" data-bs-target="#quick_view__{{ $product->id }}"
                                                data-bs-toggle="modal" class="box-icon bg_white quickview tf-btn-loading">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
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
                        <!-- pagination -->
                        {{-- FIXED: Check if $products is paginated before calling hasPages() --}}
                        @if (count($products) && method_exists($products, 'hasPages') && $products->hasPages())
                            <ul class="wg-pagination tf-pagination-list justify-content-start">
                                {{-- Previous Page Link --}}
                                @if ($products->onFirstPage())
                                    <li class="disabled">
                                        <span class="pagination-link">
                                            <span class="icon icon-arrow-left"></span>
                                        </span>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $products->previousPageUrl() }}"
                                            class="pagination-link animate-hover-btn">
                                            <span class="icon icon-arrow-left"></span>
                                        </a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @php
                                    $currentPage = $products->currentPage();
                                    $lastPage = $products->lastPage();
                                    $startPage = max(1, $currentPage - 2);
                                    $endPage = min($lastPage, $currentPage + 2);
                                @endphp

                                @for ($i = $startPage; $i <= $endPage; $i++)
                                    @if ($i == $currentPage)
                                        <li class="active">
                                            <span class="pagination-link">{{ $i }}</span>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ $products->url($i) }}"
                                                class="pagination-link animate-hover-btn">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endfor

                                {{-- Next Page Link --}}
                                @if ($products->hasMorePages())
                                    <li>
                                        <a href="{{ $products->nextPageUrl() }}"
                                            class="pagination-link animate-hover-btn">
                                            <span class="icon icon-arrow-right"></span>
                                        </a>
                                    </li>
                                @else
                                    <li class="disabled">
                                        <span class="pagination-link">
                                            <span class="icon icon-arrow-right"></span>
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                    <div class="tf-grid-layout wrapper-shop tf-col-3" id="gridLayout">
                        @if (count($products))
                            @foreach ($products as $product)
                                @php
                                    $photo = explode(',', $product->photo);
                                    $after_discount = $product->price - ($product->price * $product->discount) / 100;
                                @endphp
                                <div class="card-product grid" data-availability="In stock" data-brand="Ecomus"
                                    data-product-slug="{{ $product->slug }}" data-product-title="{{ $product->title }}"
                                    data-product-price="{{ $after_discount }}"
                                    data-product-original-price="{{ $product->price }}"
                                    data-product-discount="{{ $product->discount }}">
                                    <div class="card-product-wrapper">
                                        <a href="{{ route('product-detail.v1', $product->slug) }}" class="product-img">
                                            <img class="lazyload img-product" data-src="{{ $photo[0] }}"
                                                src="{{ $photo[0] }}" alt="{{ $product->title }}">
                                            @if (isset($photo[1]))
                                                <img class="lazyload img-hover" data-src="{{ $photo[1] }}"
                                                    src="{{ $photo[1] }}" alt="{{ $product->title }}">
                                            @endif
                                        </a>
                                        <div class="list-product-btn absolute-2">
                                            <!-- FIX: Added data-bs-target and removed href for modal trigger -->
                                            <a href="#" data-bs-target="#quick_add" data-bs-toggle="modal"
                                                class="box-icon bg_white quick-add tf-btn-loading">
                                                <span class="icon icon-bag"></span>
                                                <span class="tooltip">Quick Add</span>
                                            </a>
                                            <a href="{{ route('add-to-wishlist', $product->slug) }}"
                                                class="box-icon bg_white wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                                <span class="icon icon-delete"></span>
                                            </a>
                                            <!-- FIX: Use data-bs-target, not href for modal -->
                                            <a href="#" data-bs-target="#quick_view__{{ $product->id }}"
                                                data-bs-toggle="modal" class="box-icon bg_white quickview tf-btn-loading">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
                                        </div>
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

                        <!-- Pagination -->
                        {{-- FIXED: Check if $products is paginated before calling links() --}}
                        @if (count($products) && method_exists($products, 'links'))
                            <ul class="tf-pagination-list tf-pagination-wrap mt-4">
                                {{ $products->appends($_GET)->links() }}
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        .tf-pagination-list {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .tf-pagination-list li {
            margin: 0 5px;
        }

        .tf-pagination-list li.active .pagination-link {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .pagination-link {
            display: block;
            padding: 8px 16px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            text-decoration: none;
            color: #007bff;
        }

        .pagination-link:hover {
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .tf-pagination-list li.disabled .pagination-link {
            color: #6c757d;
            pointer-events: none;
            background-color: #fff;
            border-color: #dee2e6;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Simple pagination styling fix
        document.addEventListener('DOMContentLoaded', function() {
            // Style Laravel pagination
            const paginationLinks = document.querySelectorAll(
                '.tf-pagination-list a[rel="prev"], .tf-pagination-list a[rel="next"]');
            paginationLinks.forEach(link => {
                link.classList.add('pagination-link', 'animate-hover-btn');
                const icon = document.createElement('span');
                icon.className = link.getAttribute('rel') === 'prev' ? 'icon icon-arrow-left' :
                    'icon icon-arrow-right';
                link.innerHTML = '';
                link.appendChild(icon);
            });
        });
    </script>
@endpush
