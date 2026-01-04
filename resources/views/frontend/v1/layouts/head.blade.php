<!-- Meta Tag -->
@yield('meta')
<meta charset="utf-8">
<title>@yield('title')</title>

<meta name="author" content="themesflat.com">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description"
    content="Themesflat Ecomus - A modern and versatile eCommerce template designed for various online stores, including fashion, furniture, electronics, and more. SEO-friendly, fast-loading, and highly customizable.">

<!-- font -->
<link rel="stylesheet" href={{ asset("frontend/asset/fonts/fonts.css") }}>
<!-- Icons -->
<link rel="stylesheet" href={{ asset("frontend/asset/fonts/font-icons.css") }}>
<link rel="stylesheet" href={{ asset("frontend/asset/css/bootstrap.min.css") }}>
<link rel="stylesheet" href={{ asset("frontend/asset/css/image-compare-viewer.min.css") }}>
<link rel="stylesheet" href={{ asset("frontend/asset/css/swiper-bundle.min.css") }}>
<link rel="stylesheet" href={{ asset("frontend/asset/css/animate.css") }}>
<link rel="stylesheet" href={{ asset("frontend/asset/css/magnific-popup.min.css") }}>
<link rel="stylesheet" type="text/css" href={{ asset("frontend/asset/css/styles.css") }} />
<link rel="stylesheet" href="{{ asset("frontend/asset/css/search.css") }}">

<!-- Favicon and Touch Icons  -->
<link rel="shortcut icon" href={{ asset("frontend/asset/images/logo/favicon.png") }}>
<link rel="apple-touch-icon-precomposed" href={{ asset("frontend/asset/images/logo/favicon.png") }}>
@stack('styles')
