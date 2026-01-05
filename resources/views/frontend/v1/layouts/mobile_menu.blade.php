<!-- mobile menu -->
    <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        <div class="mb-canvas-content">
            <div class="mb-body">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                    <li class="nav-mb-item">
                        <a href="{{ route('home') }}"
                            class="mb-menu-link">Home
                        </a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="#dropdown-menu-three" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-three">
                            <span>All Categories</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-three" class="collapse">
                            <ul class="sub-nav-menu" id="sub-menu-navigation1">

                                <!-- Categories Loop - Dynamically populate categories -->
                                @foreach ($categories as $category)
                                    @if ($category->is_parent == 1) <!-- Only show parent categories -->
                                        <li>
                                            <a href="#cate-menu-{{ $category->id }}" class="sub-nav-link collapsed" data-bs-toggle="collapse" aria-expanded="true" aria-controls="cate-menu-{{ $category->id }}">
                                                <span>{{ $category->title }}</span>
                                                @php
                                                    // Get subcategories for this category
                                                    $subcategoriesByParent = $sub_category->where('parent_id', $category->id);
                                                @endphp
                                                @if ($subcategoriesByParent->count() > 0)
                                                    <span class="btn-open-sub"></span>
                                                @endif
                                            </a>

                                            <!-- If this category has subcategories, show them -->
                                            @if ($subcategoriesByParent->count() > 0)
                                                <div id="cate-menu-{{ $category->id }}" class="collapse">
                                                    <ul class="sub-nav-menu">
                                                        @foreach ($subcategoriesByParent as $subcategory)
                                                            <li>
                                                                <a href="shop-category-{{ $subcategory->id }}.html" class="sub-nav-link">
                                                                    <span>{{ $subcategory->title }}</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li class="nav-mb-item">
                        <a href="#dropdown-menu-brands" class="collapsed mb-menu-link" data-bs-toggle="collapse" aria-expanded="false" aria-controls="dropdown-menu-brands">
                            <span>Brands</span>
                            <!-- Collapse icon to show/hide sub-menu -->
                            <span class="btn-open-sub">
                                <i class="bi bi-plus"></i> <!-- Show "+" for collapse -->
                            </span>
                        </a>
                        <div id="dropdown-menu-brands" class="collapse">
                            <ul class="sub-nav-menu" id="sub-menu-brands">
                                <!-- Loop through the brands -->
                                @foreach ($megaMenuBrands as $brand)
                                    <li class="nav-item">
                                        <a href="#brand-menu-{{ $brand->id }}" class="sub-nav-link collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="brand-menu-{{ $brand->id }}">
                                            <!-- Display Brand Name -->
                                            <span class="brand-title">{{ $brand->title }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li class="nav-mb-item">
                        <a href="{{ route('home') }}"
                            class="mb-menu-link">Blog
                        </a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="{{ route('home') }}"
                            class="mb-menu-link">About Us
                        </a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="{{ route('home') }}"
                            class="mb-menu-link">Contact Us
                        </a>
                    </li>
                </ul>
                <div class="mb-other-content">
                    <div class="d-flex group-icon">
                        <a href="wishlist.html" class="site-nav-icon"><i class="icon icon-heart"></i>Wishlist</a>
                        <a href="home-search.html" class="site-nav-icon"><i class="icon icon-search"></i>Search</a>
                    </div>
                    <div class="mb-notice">
                        <a href="contact-1.html" class="text-need">Need help ?</a>
                    </div>
                    <ul class="mb-info">
                        <li>Address: {{ $settings->first()->address }}</li>
                        <li>Email: <b>{{ $settings->first()->email }}</b></li>
                        <li>Phone: <b>{{ $settings->first()->phone }}</b></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /mobile menu -->
