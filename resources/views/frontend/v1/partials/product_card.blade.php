<div class="card-product none-hover">
    <div class="card-product-wrapper">
        <a href="{{ route('product-detail', $product->slug) }}" class="product-img">
            <img class="lazyload img-product"
                data-src="{{ asset($product->photo) }}"
                src="{{ asset($product->photo) }}"
                alt="{{ $product->title }}"
                style="width: 100%; height: 300px; object-fit: cover;">
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
        @if($product->brand)
            <a href="#" class="link text_black-2">By {{ $product->brand->title }}</a>
        @endif
        <a href="{{ route('product-detail', $product->slug) }}" class="title link">{{ $product->title }}</a>
        <span class="price">${{ number_format($product->price, 2) }}</span>
    </div>
</div>
