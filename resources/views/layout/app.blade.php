 @php
    $items = \App\Models\CartItem::where('user_id', auth()->id())->with('product')->get();
    $cartSubtotal = $items->sum(fn($item) => ($item->product->price * $item->quantity)+$item->shipping_charge);
     $address = \App\Models\Address::where('user_id', auth()->id())->first(['postal_code']);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="multikart">
    <meta name="keywords" content="multikart">
    <meta name="author" content="multikart">
    <link rel="icon" href="{{asset('assets/images/vegetables-4/favicon.png')}}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{asset('assets/images/vegetables-4/favicon.png')}}" type="image/x-icon" />
    <title>Multikart - Multi-purpose E-commerce Html Template</title>

    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fo nts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/remixicon.css')}}">

    <!-- Slick slider css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/slick.css')}}">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/themify-icons.css')}}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/bootstrap.css')}}">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">

     <!-- Price range icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/price-range.css')}}">


</head>

<body class="theme-color-30 mulish-font">

    <!-- loader start -->
    <div class="loader_skeleton">
        <div class="top-panel-adv">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-10">
                        <div class="panel-left-content">
                            <h4 class="mb-0">Welcome to Multikart!! Delivery in <span>10 Minutes.</span> </h4>
                            <div class="delivery-area d-md-block d-none">
                                <div>
                                    <h5>Limited Time offer</h5>
                                    <h4>code: 25FsfuABdS</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <a href="javascript:void(0)" class="close-btn"><i data-feather="x"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <header class="style-light header-compact">
            <div class="top-header top-header-theme">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="header-contact">
                                <ul>
                                    <li>Welcome to Our store Multikart</li>
                                    <li><a href="become-vendor.html" class="text-white fw-bold">Become a Vendor</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 text-end">
                            <ul class="header-dropdown">
                                <li class="mobile-wishlist pe-0"><a href="#!"><i class="ri-heart-fill"></i></a>
                                </li>
                                <li class="onhover-dropdown mobile-account"><i class="ri-user-fill"></i>
                                @if (Auth::check())
                                        {{ Auth::user()->name }}
                                    @else
                                        My Account 12
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="main-menu">
                            <div class="menu-left">
                                <div class="brand-logo">
                                    <a href="{{url('')}}"><img src="{{asset('assets/images/vegetables-4/logo.png')}}"
                                            class="img-fluid blur-up lazyload" alt=""></a>
                                </div>
                            </div>
                            <div>
                                <form class="form_search" role="form" method="POST" action="{{ route('search') }}">
                                    <input type="search" placeholder="Search any Device or Gadgets..."
                                        class="nav-search nav-search-field">
                                    <button type="submit" name="nav-submit-button" class="btn-search">
                                        <i class="ri-search-line"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="menu-right pull-right">
                                <div>
                                    <div class="icon-nav">
                                        <ul>
                                            <li class="onhover-div mobile-search d-xl-none d-sm-inline-block d-none">
                                                <div><i class="ri-search-line"></i></div>
                                            </li>
                                            <li class="onhover-div mobile-setting d-sm-inline-block d-none">
                                                <div><i class="ri-settings-2-line"></i></div>
                                                <div class="show-div setting">
                                                    <h6>language</h6>
                                                    <ul>
                                                        <li><a href="#!">english</a></li>
                                                        <li><a href="#!">french</a></li>
                                                    </ul>
                                                    <h6>currency</h6>
                                                    <ul class="list-inline">
                                                        <li><a href="#!">euro</a></li>
                                                        <li><a href="#!">rupees</a></li>
                                                        <li><a href="#!">pound</a></li>
                                                        <li><a href="#!">dollar</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="onhover-div mobile-cart d-sm-inline-block d-none">
                                                <div><i class="ri-shopping-cart-line"></i></div>
                                                <span class="cart_qty_cls">{{ $items->count() }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-part bottom-light">
                <div class="container">
                    <div class="row">
                        <div class="col-12 menu-row">
                            @if(!empty($address->postal_code))
                            <div data-bs-toggle="modal" data-bs-target="#deliveryarea"
                                class="delivery-area d-md-flex d-none">
                                <i data-feather="map-pin"></i>
                                <div>
                                    <h6>Delivery to</h6>
                                    <h5>{{$address->postal_code ?? ''}}</h5>
                                </div>
                            </div>
                            @endif
                            <div class="main-nav-center">
                                <nav class="text-start">
                                    <div class="toggle-nav"><i class="ri-bar-chart-horizontal-line sidebar-bar"></i>
                                    </div>
                                    <ul class="sm pixelstrap sm-horizontal">
                                        <li>
                                            <div class="mobile-back text-end">Back<i class="fa fa-angle-right ps-2"></i>
                                            </div>
                                        </li>
                                        <li><a href="#!">Home</a></li>
                                        <li class="mega hover-cls">
                                            <a href="#!">feature</a>
                                        </li>
                                        <li><a href="#!">shop</a></li>
                                        <li><a href="#!">product</a></li>
                                        <li><a href="#!">pages</a></li>
                                        <li><a href="#!">blog</a></li>
                                          <li><a href="{{ route('aboutus') }}">About Us</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="delivery-area d-xl-flex d-none ms-auto me-0">
                                <div>
                                    <h5>Call us: {{$setting->phone}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="small-slider">
            <div class="home-slider">
                <div class="home"></div>
            </div>
        </div>
        <section class="vegetables-category">
            <div class="container">
                <div class="vector-slide-8 no-arrow slick-default-margin ratio_square">
                    <div>
                        <div class="category-boxes">
                        </div>
                    </div>
                    <div>
                        <div class="category-boxes">
                        </div>
                    </div>
                    <div>
                        <div class="category-boxes">
                        </div>
                    </div>
                    <div>
                        <div class="category-boxes">
                        </div>
                    </div>
                    <div>
                        <div class="category-boxes">
                        </div>
                    </div>
                    <div>
                        <div class="category-boxes">
                        </div>
                    </div>
                    <div>
                        <div class="category-boxes">
                        </div>
                    </div>
                    <div>
                        <div class="category-boxes">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="collection-banner banner-padding">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="ldr-bg">
                            <div class="contain-banner banner-3">
                                <div>
                                    <h4></h4>
                                    <h2></h2>
                                    <h6></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ldr-bg">
                            <div class="contain-banner banner-3">
                                <div>
                                    <h4></h4>
                                    <h2></h2>
                                    <h6></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ldr-bg">
                            <div class="contain-banner banner-3">
                                <div>
                                    <h4></h4>
                                    <h2></h2>
                                    <h6></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- loader end -->

    <!-- header start -->
    <header id="sticky-header" class="style-light header-compact">
        <div class="mobile-fix-option"></div>
        <div class="top-header top-header-theme">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header-contact">
                            <ul>
                                <li>Welcome to Our store Multikart</li>
                                <li><a href="become-vendor.html" class="text-white fw-bold">Become a Vendor</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 text-end">
                        <ul class="header-dropdown">
                            <li class="mobile-wishlist pe-0"><a href="#!"><i class="ri-heart-fill"></i></a>
                            </li>
                            <li class="onhover-dropdown mobile-account"><i class="ri-user-fill"></i>
                                @if (Auth::check())
                                        {{ Auth::user()->name }}
                                       
                                    @else
                                        My Account 
                                    @endif
                                <ul class="onhover-show-div">
                                @if (Auth::check())
                                <li><a href="{{route('userProfile')}}">Profile Info</a></li>
                                <li><a href="{{route('userdashboard')}}">Dashboard</a></li>
                                <li><a href="{{route('userlogout')}}">Logout</a></li>
                                    @else
                                    <li><a href="{{route('authlogin')}}">Login</a></li>
                                    <li><a href="{{route('register')}}">register</a></li>
                                  
                                    @endif
                                    
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="main-menu">
                        <div class="menu-left">
                            <div class="brand-logo">
                                <a href="{{url('')}}"><img src="{{asset('assets/images/vegetables-4/logo.png')}}"
                                        class="img-fluid blur-up lazyload" alt=""></a>
                            </div>
                        </div>
                        <div>
                            <form class="form_search" role="form" method="POST" action="{{ route('search') }}">
                                @csrf
                                <input type="search" placeholder="Search any Device or Gadgets..."
                                    class="nav-search nav-search-field"  name="searchValues" value="">
                                <button type="submit" class="btn-search">
                                    <i class="ri-search-line"></i>
                                </button>
                            </form>
                        </div>
                        <div class="menu-right pull-right">
                            <div>
                                <div class="icon-nav">
                                    <ul>
                                        <li class="onhover-div mobile-search">
                                            <div data-bs-toggle="modal" data-bs-target="#searchModal">
                                                <i class="ri-search-line"></i>
                                            </div>
                                        </li>

                                        <li class="onhover-div mobile-setting">
                                            <div><i class="ri-settings-2-line"></i></div>
                                            <div class="show-div setting">
                                                <h6>language</h6>
                                                <ul>
                                                    <li><a href="#!">english</a></li>
                                                    <li><a href="#!">french</a></li>
                                                </ul>
                                                <h6>currency</h6>
                                                <ul class="list-inline">
                                                    <li><a href="#!">euro</a></li>
                                                    <li><a href="#!">rupees</a></li>
                                                    <li><a href="#!">pound</a></li>
                                                    <li><a href="#!">dollar</a></li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="onhover-div mobile-cart">
                                            <div data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
                                                <i class="ri-shopping-cart-line"></i>
                                            </div>
                                            <span class="cart_qty_cls" id="cart_qty_cls">{{ $items->count() }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-part bottom-light">
            <div class="container">
                <div class="row">
                    <div class="col-12 menu-row">
                         @if(!empty($address->postal_code))
                        <div data-bs-toggle="modal" data-bs-target="#deliveryarea"
                            class="delivery-area d-md-flex d-none">
                            <i data-feather="map-pin"></i>
                            <div>
                                <h6>Delivery to</h6>
                                <h5>{{$address->postal_code ?? ''}}</h5>
                            </div>
                        </div>
                          @endif
                        <div class="main-nav-center">
                            <nav id="main-nav" class="text-start">
                                <div class="toggle-nav"><i class="ri-bar-chart-horizontal-line sidebar-bar"></i></div>
                                <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                    <li class="mobile-box">
                                        <div class="mobile-back text-end">Menu<i class="ri-close-line"></i></div>
                                    </li>
                                    <li><a href="{{route('/')}}">Home</a></li>
                                    <li><a href="{{route('shop')}}">Shop</a></li>
                                   
                                    <li class="mega hover-cls">
                                        <a href="#!">product</a>
                                        <ul class="mega-menu full-mega-menu">
                                            <li>
                                                <div class="container">
                                                    <div class="row g-xl-4 g-0">
                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>Product Page</h5>
                                                                </div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li>
                                                                            <a href="product-page(thumbnail).html">Product
                                                                                Thumbnail</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(4-image).html">Product
                                                                                Image</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(slider).html">Product
                                                                                Slider</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(accordian).html">Product
                                                                                Accordion</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(sticky).html">Product
                                                                                Sticky</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(vertical-tab).html">Product
                                                                                Vertical Tab</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>Product Page</h5>
                                                                </div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li>
                                                                            <a href="product-page(left-sidebar).html">Product
                                                                                Sidebar Left</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(right-sidebar).html">Product
                                                                                Sidebar Right</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(no-sidebar).html">Product
                                                                                No Sidebar</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(accordian).html">Product
                                                                                Column Thumbnail</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(image-outside).html">Product
                                                                                Thumbnail Image Outside</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>Product Variants Style</h5>
                                                                </div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li>
                                                                            <a href="product-page(3-column).html">Variant
                                                                                Rectangle</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(accordian).html">Variant
                                                                                Circle</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(accordian).html">Variant
                                                                                Image Swatch</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(3-column).html">Variant
                                                                                Color</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(vertical-tab).html">Variant
                                                                                Radio Button</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(sticky).html">Variant
                                                                                Dropdown</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>Product Features</h5>
                                                                </div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li>
                                                                            <a href="product-page(accordian).html">Product
                                                                                Simple</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(left-sidebar).html">Product
                                                                                Classified</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(no-sidebar).html">Size
                                                                                Chart</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(no-sidebar).html">Delivery
                                                                                & Return</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(no-sidebar).html">Product
                                                                                Review</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(no-sidebar).html">Ask
                                                                                an Expert</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>Product Features</h5>
                                                                </div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li>
                                                                            <a href="product-page(bundle).html">Bundle
                                                                                (Cross Sale)</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(accordian).html">Hot
                                                                                Stock
                                                                                Progress</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(accordian).html">Out
                                                                                Stock</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(thumbnail).html">Sale
                                                                                Countdown</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(thumbnail).html">Product
                                                                                Zoom</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>Product Features</h5>
                                                                </div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li>
                                                                            <a href="product-page(accordian).html">Sticky
                                                                                Checkout</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(accordian).html">Secure
                                                                                Checkout</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(vertical-tab).html">Social
                                                                                Share</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(thumbnail).html">Related
                                                                                Products</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="product-page(right-sidebar).html">Wishlist
                                                                                & Compare</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <img src="{{asset('assets/images/menu-banner.jpg')}}" alt=""
                                                                class="img-fluid mega-img d-xl-block d-none">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- <li><a href="#!">pages</a>
                                        <ul>
                                            <li>
                                                <a href="#!">vendor</a>
                                                <ul>
                                                    <li><a href="vendor-dashboard.html">vendor dashboard</a>
                                                    </li>
                                                    <li><a href="vendor-profile.html">vendor profile</a></li>
                                                    <li><a href="become-vendor.html">become vendor</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#!">account</a>
                                                <ul>
                                                    <li><a href="wishlist.html">wishlist</a></li>
                                                    <li><a href="cart.html">cart</a></li>
                                                    <li><a href="dashboard.html">Dashboard</a></li>
                                                    <li><a href="{{route('authlogin')}}">login</a></li>
                                                    <li><a href="{{route('register')}}">register</a></li>
                                                    <li><a href="contact.html">contact</a></li>
                                                    <li><a href="forget_pwd.html">forget password</a></li>
                                                    <li><a href="profile.html">profile</a></li>
                                                    <li><a href="checkout.html">checkout</a></li>
                                                    <li><a href="order-success.html">order success</a></li>
                                                    <li><a href="order-tracking.html">order tracking<span
                                                                class="new-tag">new</span></a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#!">portfolio</a>
                                                <ul>
                                                    <li><a href="">grid</a>
                                                        <ul>
                                                            <li><a href="grid-2-col.html">grid
                                                                    2</a></li>
                                                            <li><a href="grid-3-col.html">grid
                                                                    3</a></li>
                                                            <li><a href="grid-4-col.html">grid
                                                                    4</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="">masonry</a>
                                                        <ul>
                                                            <li><a href="masonary-2-grid.html">grid 2</a></li>
                                                            <li><a href="masonary-3-grid.html">grid 3</a></li>
                                                            <li><a href="masonary-4-grid.html">grid 4</a></li>
                                                            <li><a href="masonary-fullwidth.html">full width</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="about-page.html">about us</a></li>
                                            <li><a href="search.html">search</a></li>
                                            <li><a href="review.html">review</a>
                                            </li>
                                            <li>
                                                <a href="#!">compare</a>
                                                <ul>
                                                    <li><a href="compare.html">compare</a></li>
                                                    <li><a href="compare-2.html">compare-2</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="collection.html">collection</a></li>
                                            <li><a href="lookbook.html">lookbook</a></li>
                                            <li><a href="sitemap.html">site map</a>
                                            </li>
                                            <li><a href="404.html">404</a></li>
                                            <li><a href="coming-soon.html">coming soon</a></li>
                                            <li><a href="faq.html">FAQ</a></li>
                                        </ul>
                                    </li> -->
                                    <li>
                                        <a href="{{ route('blogs') }}">blog</a>
                                    </li>
                                     <li><a href="{{ route('aboutus') }}">About Us</a></li>
                                       <li><a href="{{ route('contactus') }}">contact Us</a></li>
                                    
                                </ul>
                            </nav>
                        </div>
                        <div class="delivery-area d-xl-flex d-none ms-auto me-0">
                            <div>
                                <h5>Call us: {{$setting->phone}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->

    @yield('content')

     <!-- Footer Section Start -->
    <!-- footer start -->
    <footer class="footer-light footer-expand pb-0">
        <div class="section-t-space section-b-space light-layout">
            <div class="container">
                <div class="row footer-theme partition-f">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-title footer-mobile-title">
                            <h4>about</h4>
                        </div>
                        <div class="footer-content">
                            <a href="{{url('')}}" class="d-block footer-logo">
                                <img src="{{asset('assets/images/vegetables-4/logo.png')}}" alt="">
                            </a>
                            <p>Discover the latest fashion trends, explore unique styles, and enjoy seamless shopping
                                with our carefully curated exclusive collections, designed to elevate your wardrobe.</p>
                            <ul class="store-details">
                                <li>
                                    <a href="https://play.google.com/">
                                        <img src="{{asset('assets/images/store/google.png')}}" class="img-fluid" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.apple.com/in/app-store/">
                                        <img src="{{asset('assets/images/store/app.png')}}" class="img-fluid" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="sub-title">
                            <div class="footer-title">
                                <h4>my account</h4>
                            </div>
                            <div class="footer-content">
                                <ul>
                                    <li><a href="#!">mens</a></li>
                                    <li><a href="#!">womans</a></li>
                                    <li><a href="#!">clothing</a></li>
                                    <li><a href="#!">accessories</a></li>
                                    <li><a href="#!">featured</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="sub-title">
                            <div class="footer-title">
                                <h4>why we choose</h4>
                            </div>
                            <div class="footer-content">
                                <ul>
                                    <li><a href="#!">shipping & return</a></li>
                                    <li><a href="#!">secure shopping</a></li>
                                    <li><a href="#!">gallery</a></li>
                                    <li><a href="{{ route('terms_condition') }}">Terms and Condition</a></li>
                                     <li><a href="{{ route('privacy_policy') }}">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="sub-title">
                            <div class="footer-title">
                                <h4>store information</h4>
                            </div>
                            <div class="footer-content">
                                <ul class="contact-list">
                                    <li><i class="ri-map-pin-2-fill"></i>{{ $setting->website_name }}, {{ $setting->address }}
                                        </li>
                                    <li><i class="ri-phone-fill"></i>Call Us: {{ $setting->phone }}</li>
                                    <li><i class="ri-mail-fill"></i>Email Us: <a href="#!">{{ $setting->email }}</a>
                                    </li>
                                    <li><i class="ri-printer-fill"></i>Fax: 123456</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row small-section pb-0 d-md-block d-none">
                    <div class="col-12 popular-search-section">
                        <h4>Popular Searches</h4>
                        <ul>
                            <li><a href="#!">frozen food</a></li>
                            <li><a href="#!">best value</a></li>
                            <li><a href="#!">lowest price</a></li>
                            <li><a href="#!">bakery & biscuits</a></li>
                            <li><a href="#!">vegetables</a></li>
                            <li><a href="#!">fruits</a></li>
                            <li><a href="#!">eggs, meat, fish</a></li>
                            <li><a href="#!">household items</a></li>
                            <li><a href="#!">Dairy items</a></li>
                            <li><a href="#!">biscuits & snacks</a></li>
                            <li><a href="#!">chocolates</a></li>
                            <li><a href="#!">occasions & decor</a></li>
                            <li><a href="#!">personal care</a></li>
                            <li><a href="#!">kitchen items</a></li>
                            <li><a href="#!">cold drinks & juices</a></li>
                            <li><a href="#!">munchies</a></li>
                            <li><a href="#!">battery & bulb</a></li>
                            <li><a href="#!">Stationery needs</a></li>
                            <li><a href="#!">Milk</a></li>
                            <li><a href="#!">sunflower oils</a></li>
                            <li><a href="#!">health drinks</a></li>
                            <li><a href="#!">organic items</a></li>
                            <li><a href="#!">leafy vegetables</a></li>
                            <li><a href="#!">veg food</a></li>
                        </ul>
                        <h4 class="mt-5">Cities we serve</h4>
                        <ul>
                            <li><a href="#!">New York</a></li>
                            <li><a href="#!">Los Angeles</a></li>
                            <li><a href="#!">Chicago</a></li>
                            <li><a href="#!">Houston</a></li>
                            <li><a href="#!">Phoenix</a></li>
                            <li><a href="#!">Philadelphia</a></li>
                            <li><a href="#!">San Antonio</a></li>
                            <li><a href="#!">San Diego</a></li>
                            <li><a href="#!">Dallas</a></li>
                            <li><a href="#!">San Jose</a></li>
                            <li><a href="#!">Austin</a></li>
                            <li><a href="#!">Columbus, Ohio</a></li>
                            <li><a href="#!">Boston</a></li>
                            <li><a href="#!">Portland</a></li>
                            <li><a href="#!">Las Vegas</a></li>
                            <li><a href="#!">Albuquerque</a></li>
                            <li><a href="#!">Fresno, California</a></li>
                            <li><a href="#!">Raleigh</a></li>
                            <li><a href="#!">Miami</a></li>
                            <li><a href="#!">Oakland</a></li>
                            <li><a href="#!">Saint Paul</a></li>
                            <li><a href="#!">Santa Ana</a></li>
                            <li><a href="#!">Jersey City</a></li>
                            <li><a href="#!">Durham</a></li>
                        </ul>
                        <h4 class="mt-5">About Multikart</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua. Ut enim ad minim veniam,sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                        <h4 class="mt-5">Payment partners</h4>
                        <div>
                            <img src="{{asset('assets/images/payment-footer.png')}}" alt="" class="img-fluid payment-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="footer-end">
                            <p><i class="ri-copyright-line"></i> 2024-25 themeforest powered by
                                pixelstrap</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="payment-card-bottom">
                            <img src="{{asset('assets/images/payment.png')}}" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->


    <!--modal popup start-->
    <!-- <div class="modal fade bd-example-modal-lg theme-modal" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body modal10">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="modal-bg">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"><span>&times;</span></button>
                                    <div class="offer-content"><img src="{{asset('assets/images/Offer-banner.png')}}"
                                            class="img-fluid blur-up lazyload" alt="">
                                        <h2>newsletter</h2>
                                        <form
                                            action="https://pixelstrap.us19.list-manage.com/subscribe/post?u=5a128856334b598b395f1fc9b&amp;id=082f74cbda"
                                            class="auth-form needs-validation" method="post"
                                            id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                                            target="_blank">
                                            <div class="form-group mx-sm-3">
                                                <input type="text" class="form-control" name="EMAIL" id="mce-EMAIL"
                                                    placeholder="Enter your email" required="required">
                                                <button type="submit" class="btn btn-solid"
                                                    id="mc-submit">subscribe</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!--modal popup end-->


    <!-- Modal -->
    <div class="modal fade" id="deliveryarea" tabindex="-1" aria-labelledby="deliveryareaLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Delivery Address</h5>
                    <button type="button" class="btn-close position-relative h-auto" data-bs-dismiss="modal"
                        aria-label="Close"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="name">Select your city to start shopping</label>
                            <select class="form-select">
                                <option selected>Select City</option>
                                <option value="1">New York</option>
                                <option value="2">Tokyo</option>
                                <option value="3">London</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="name">Enter your area / pincode</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Pincode" required="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->


    <!-- theme setting start -->
    <div class="theme-settings">
        <button onclick="openSetting()" class="setting-sidebar btn" id="setting-icon">
            <i class="ri-sound-module-line"></i>
            Customize
        </button>
    </div>

    <div class="scroll-setting-box">
        <div id="setting_box" class="setting-box">
            <a href="#!" class="overlay" onclick="closeSetting()"></a>
            <div class="setting-title">
                <h4>Theme Setting</h4>
                <a href="#!" class="close-icon" onclick="closeSetting()">
                    <i class="ri-close-large-line"></i>
                </a>
            </div>

            <div class="setting_box_body">
                <div class="accordion custemizer-accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne">
                                <span class="setting-description-text">
                                    <span class="setting-title-content">50+ Demo</span>
                                    <span class="setting-content">Explore 50+ demos</span>
                                </span>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="setting-body">
                                    <div class="setting-contant">
                                        <div class="row demo-section g-3">
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="{{url('')}}" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/fashion-1.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="fashion-2.html" class="demo-text">
                                                        <span>fashion 1</span>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="fashion-2.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/fashion-2.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="fashion-2.html" class="demo-text">
                                                        <span>fashion 2</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="fashion-3.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/fashion-3.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="fashion-3.html" class="demo-text">
                                                        <span>fashion 3</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="fashion-4.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/fashion-4.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="fashion-4.html" class="demo-text">
                                                        <span>fashion 4</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="fashion-5.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/fashion-5.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="fashion-5.html" class="demo-text">
                                                        <span>fashion 5</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="fashion-6.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/fashion-6.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="fashion-6.html" class="demo-text">
                                                        <span>fashion 6</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="fashion-7.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/fashion-7.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="fashion-7.html" class="demo-text">
                                                        <span>fashion 7</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="furniture.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/furniture-1.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="furniture.html" class="demo-text">
                                                        <span>furniture</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="furniture-2.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/furniture-2.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="furniture-2.html" class="demo-text">
                                                        <span>furniture 2</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="furniture-3.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/furniture-dark.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="furniture-3.html" class="demo-text">
                                                        <span>furniture dark</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="electronic-1.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/electronic-1.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="electronic-1.html" class="demo-text">
                                                        <span>electronics</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="electronic-2.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/electronic-2.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="electronic-2.html" class="demo-text">
                                                        <span>electronics 2</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="electronic-3.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/electronic-3.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="electronic-3.html" class="demo-text">
                                                        <span>electronics 3</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="marketplace-demo.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/marketplace-1.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="marketplace-demo.html" class="demo-text">
                                                        <span>marketplace</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="marketplace-demo-2.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/marketplace-2.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="marketplace-demo-2.html" class="demo-text">
                                                        <span>marketplace 2</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="marketplace-demo-3.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/marketplace-3.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="marketplace-demo-3.html" class="demo-text">
                                                        <span>marketplace 3</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="marketplace-demo-4.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/marketplace-4.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="marketplace-demo-4.html" class="demo-text">
                                                        <span>marketplace 4</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="vegetables.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/vegetable-1.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="vegetables.html" class="demo-text">
                                                        <span>vegetables</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="vegetables-2.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/vegetable-2.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="vegetables-2.html" class="demo-text">
                                                        <span>vegetables 2</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="vegetables-3.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/vegetable-3.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="vegetables-3.html" class="demo-text">
                                                        <span>vegetables 3</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="vegetables-4.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/vegetable-4.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="vegetables-4.html" class="demo-text">
                                                        <span>Vegetables 4 </span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="vegetables-5.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/vegetable-5.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="vegetables-5.html" class="demo-text">
                                                        <span>Vegetables 5 </span>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="jewellery.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/jewellery-1.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="jewellery.html" class="demo-text">
                                                        <span>jewellery</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="jewellery-2.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/jewellery-2.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="jewellery-2.html" class="demo-text">
                                                        <span>jewellery 2</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="jewellery-3.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/jewellery-3.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="jewellery-3.html" class="demo-text">
                                                        <span>jewellery 3</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="bags.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/bag.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="bags.html" class="demo-text">
                                                        <span>bag</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="watch.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/watch.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="watch.html" class="demo-text">
                                                        <span>watch</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="medical.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/medical.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="medical.html" class="demo-text">
                                                        <span>medical</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="perfume.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/perfume.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="perfume.html" class="demo-text">
                                                        <span>perfume</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="yoga.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/yoga.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="yoga.html" class="demo-text">
                                                        <span>yoga</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="christmas.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/christmas.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="christmas.html" class="demo-text">
                                                        <span>christmas</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="bicycle.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/bicycle.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="bicycle.html" class="demo-text">
                                                        <span>bicycle</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="marijuana.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/marijuna.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="marijuana.html" class="demo-text">
                                                        <span>marijuana</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="gym-product.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/gym.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="gym-product.html" class="demo-text">
                                                        <span>gym</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="tools.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/tools.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="tools.html" class="demo-text">
                                                        <span>tools</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="shoes.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/shoes.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="shoes.html" class="demo-text">
                                                        <span>shoes</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="books.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/books.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="books.html" class="demo-text">
                                                        <span>books</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="kids.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/kids.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="kids.html" class="demo-text">
                                                        <span>kids</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="game.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/games.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="game.html" class="demo-text">
                                                        <span>game</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="beauty.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/beauty.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="beauty.html" class="demo-text">
                                                        <span>beauty</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="left_sidebar-demo.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/left-sidebar.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="left_sidebar-demo.html" class="demo-text">
                                                        <span>left sidebar</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="video-slider.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/video_slider.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="video-slider.html" class="demo-text">
                                                        <span>video slider</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="metro.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/metro.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="metro.html" class="demo-text">
                                                        <span>metro</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="goggles.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/goggles.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="goggles.html" class="demo-text">
                                                        <span>goggles</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="flower.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/flowers.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="flower.html" class="demo-text">
                                                        <span>flower</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="light.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/light.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="light.html" class="demo-text">
                                                        <span>light</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="nursery.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/nursery.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="nursery.html" class="demo-text">
                                                        <span>nursery</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="pets.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/pets.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="pets.html" class="demo-text">
                                                        <span>pets</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="video.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/video.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="video.html" class="demo-text">
                                                        <span>video</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="gradient.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/gradient.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="gradient.html" class="demo-text">
                                                        <span>gradient</span>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="lookbook-demo.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/lookbook.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="lookbook-demo.html" class="demo-text">
                                                        <span>lookbook</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="full-page.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/full_page.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="full-page.html" class="demo-text">
                                                        <span>full page</span>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="parallax.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/parallax.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="parallax.html" class="demo-text">
                                                        <span>parallax</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center demo-effects">
                                                <div class="set-position">
                                                    <a href="nft.html" class="layout-container">
                                                        <img src="{{asset('assets/images/custemizer/demo/nft.png')}}"
                                                            class="img-fluid" alt="">
                                                    </a>
                                                    <a href="nft.html" class="demo-text">
                                                        <span>NFT </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="setting-section">
                    <div class="setting-inner-title">
                        <h5>RTL Mode</h5>
                        <p>Change Language Direction</p>
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" role="switch" id="rtlmode" class="form-check-input">
                    </div>
                </div>
                <div class="setting-section">
                    <div class="setting-inner-title">
                        <h5>Dark Mode</h5>
                        <p>Switch Between Light And Dark Mode</p>
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" role="switch" id="darkmode" class="form-check-input">
                    </div>
                </div>
                <div class="setting-section">
                    <div class="setting-inner-title">
                        <a target="_blank" href="#!">Admin</a>
                        <p>Backend Admin Panel</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- theme setting end -->


    <!-- Add to cart modal popup start-->
    <div class="modal fade bd-example-modal-lg theme-modal cart-modal" id="addtocart" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body modal1">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="modal-bg addtocart">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                    <div class="media">
                                        <a href="#!">
                                            <img class="img-fluid blur-up lazyload pro-img"
                                                src="{{asset('assets/images/fashion/product/55.jpg')}}" alt="">
                                        </a>
                                        <div class="media-body align-self-center text-center">
                                            <a href="#!">
                                                <h6>
                                                    <i class="fa fa-check"></i>Item
                                                    <span>men full sleeves</span>
                                                    <span> successfully added to your Cart</span>
                                                </h6>
                                            </a>
                                            <div class="buttons">
                                                <a href="#!" class="view-cart btn btn-solid">Your cart</a>
                                                <a href="#!" class="checkout btn btn-solid">Check out</a>
                                                <a href="#!" class="continue btn btn-solid">Continue shopping</a>
                                            </div>

                                            <div class="upsell_payment">
                                                <img src="{{asset('assets/images/payment_cart.png')}}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-section">
                                        <div class="col-12 product-upsell text-center">
                                            <h4>Customers who bought this item also.</h4>
                                        </div>
                                        <div class="row" id="upsell_product">
                                            <div class="product-box col-sm-3 col-6">
                                                <div class="img-wrapper">
                                                    <div class="front">
                                                        <a href="#!">
                                                            <img src="{{asset('assets/images/fashion/product/1.jpg')}}"
                                                                class="img-fluid blur-up lazyload mb-1"
                                                                alt="cotton top">
                                                        </a>
                                                    </div>
                                                    <div class="product-detail">
                                                        <h6><a href="#!"><span>cotton top</span></a></h6>
                                                        <h4><span>$25</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-box col-sm-3 col-6">
                                                <div class="img-wrapper">
                                                    <div class="front">
                                                        <a href="#!">
                                                            <img src="{{asset('assets/images/fashion/product/34.jpg')}}"
                                                                class="img-fluid blur-up lazyload mb-1"
                                                                alt="cotton top">
                                                        </a>
                                                    </div>
                                                    <div class="product-detail">
                                                        <h6><a href="#!"><span>cotton top</span></a></h6>
                                                        <h4><span>$25</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-box col-sm-3 col-6">
                                                <div class="img-wrapper">
                                                    <div class="front">
                                                        <a href="#!">
                                                            <img src="{{asset('assets/images/fashion/product/13.jpg')}}"
                                                                class="img-fluid blur-up lazyload mb-1"
                                                                alt="cotton top">
                                                        </a>
                                                    </div>
                                                    <div class="product-detail">
                                                        <h6><a href="#!"><span>cotton top</span></a></h6>
                                                        <h4><span>$25</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-box col-sm-3 col-6">
                                                <div class="img-wrapper">
                                                    <div class="front">
                                                        <a href="#!">
                                                            <img src="{{asset('assets/images/fashion/product/19.jpg')}}"
                                                                class="img-fluid blur-up lazyload mb-1"
                                                                alt="cotton top">
                                                        </a>
                                                    </div>
                                                    <div class="product-detail">
                                                        <h6><a href="#!"><span>cotton top</span></a></h6>
                                                        <h4><span>$25</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add to cart modal popup end-->


    <!-- Quick-view modal popup start-->
    <div class="modal fade bd-example-modal-lg theme-modal" id="quick-view" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content quick-view-modal">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                    <div class="row">
                        <div class="col-lg-6  col-xs-12">
                            <div class="quick-view-img">
                                <img src="{{asset('assets/images/pro3/1.jpg')}}" alt="" class="img-fluid blur-up lazyload">
                            </div>
                        </div>
                        <div class="col-lg-6 rtl-text">
                            <div class="product-right">
                                <h2> Women Pink Shirt </h2>
                                <h3>$32.96 </h3>
                                <ul class="color-variant">
                                    <li class="bg-light0"></li>
                                    <li class="bg-light1"></li>
                                    <li class="bg-light2"></li>
                                </ul>
                                <div class="border-product">
                                    <h6 class="product-title">product details</h6>
                                    <p>Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium
                                        doloremque laudantium</p>
                                </div>
                                <div class="product-description border-product">
                                    <div class="size-box">
                                        <ul>
                                            <li class="active"><a href="javascript:void(0)">s</a></li>
                                            <li><a href="javascript:void(0)">m</a></li>
                                            <li><a href="javascript:void(0)">l</a></li>
                                            <li><a href="javascript:void(0)">xl</a></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-title">quantity</h6>
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn quantity-left-minus" data-type="minus"
                                                    data-field="">
                                                    <i class="ri-arrow-left-s-line"></i>
                                                </button>
                                            </span>
                                            <input type="text" name="quantity" class="form-control input-number"
                                                value="1">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn quantity-right-plus" data-type="plus"
                                                    data-field="">
                                                    <i class="ri-arrow-right-s-line"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-buttons">
                                    <a href="#!" class="btn btn-solid">add to cart</a>
                                    <a href="#!" class="btn btn-solid">view detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick-view modal popup end-->


    <!-- tap to top -->
    <div class="tap-top">
        <div>
            <i class="ri-arrow-up-double-line"></i>
        </div>
    </div>
    <!-- tap to top End -->


    <!-- Search Modal Start -->
    <div class="modal fade search-modal theme-modal-2" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5">Search in store</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="search-input-box">
                        <input type="text" class="form-control" placeholder="Search with brands and categories...">
                        <i class="ri-search-2-line"></i>
                    </div>

                    <ul class="search-category">
                        <li class="category-title">Top search:</li>
                        <li>
                            <a href="category-page.html">Baby Essentials</a>
                        </li>
                        <li>
                            <a href="category-page.html">Bag Emporium</a>
                        </li>
                        <li>
                            <a href="category-page.html">Bags</a>
                        </li>
                        <li>
                            <a href="category-page.html">Books</a>
                        </li>
                    </ul>

                    <div class="search-product-box mt-sm-4 mt-3">
                        <h3 class="search-title">Most Searched</h3>

                        <div class="row row-cols-xl-4 row-cols-md-3 row-cols-2 g-sm-4 g-3">
                            <div class="col">
                                <div class="basic-product theme-product-1">
                                    <div class="overflow-hidden">
                                        <div class="img-wrapper">
                                            <div class="ribbon"><span>Exclusive</span></div>
                                            <a href="product-page(image-swatch).html">
                                                <img src="{{asset('assets/images/fashion-1/product/1.jpg')}}"
                                                    class="img-fluid blur-up lazyloaded" alt="">
                                            </a>
                                            <div class="rating-label"><i class="ri-star-fill"></i><span>2.5</span>
                                            </div>
                                            <div class="cart-info">
                                                <a href="#!" title="Add to Wishlist" class="wishlist-icon">
                                                    <i class="ri-heart-line"></i>
                                                </a>
                                                <button data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas"
                                                    title="Add to cart">
                                                    <i class="ri-shopping-cart-line"></i>
                                                </button>
                                                <a href="#quickView" data-bs-toggle="modal" title="Quick View">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="compare.html" title="Compare">
                                                    <i class="ri-loop-left-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div>
                                                <div class="brand-w-color">
                                                    <a class="product-title" href="product-page(accordian).html">
                                                        Glamour Gaze
                                                    </a>
                                                    <div class="color-panel">
                                                        <ul>
                                                            <li style="background-color: papayawhip;"></li>
                                                            <li style="background-color: burlywood;"></li>
                                                            <li style="background-color: gainsboro;"></li>
                                                        </ul>
                                                        <span>+2</span>
                                                    </div>
                                                </div>
                                                <h6>Boyfriend Shirts</h6>
                                                <h4 class="price">$ 2.79<del> $3.00 </del><span
                                                        class="discounted-price"> 7%
                                                        Off
                                                    </span>
                                                </h4>
                                            </div>
                                            <ul class="offer-panel">
                                                <li>
                                                    <span class="offer-icon">
                                                        <i class="ri-discount-percent-fill"></i>
                                                    </span>
                                                    Limited Time Offer: 4% off
                                                </li>
                                                <li><span class="offer-icon"><i
                                                            class="ri-discount-percent-fill"></i></span>
                                                    Limited Time Offer: 4% off</li>
                                                <li><span class="offer-icon"><i
                                                            class="ri-discount-percent-fill"></i></span>
                                                    Limited Time Offer: 4% off</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="basic-product theme-product-1">
                                    <div class="overflow-hidden">
                                        <div class="img-wrapper">
                                            <a href="product-page(accordian).html"><img
                                                    src="{{asset('assets/images/fashion-1/product/11.jpg')}}"
                                                    class="img-fluid blur-up lazyloaded" alt=""></a>
                                            <div class="rating-label"><i class="fa fa-star"></i>
                                                <span>6.5</span>
                                            </div>
                                            <div class="cart-info">
                                                <a href="#!" title="Add to Wishlist" class="wishlist-icon">
                                                    <i class="ri-heart-line"></i>
                                                </a>
                                                <button data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas"
                                                    title="Add to cart">
                                                    <i class="ri-shopping-cart-line"></i>
                                                </button>
                                                <a href="#quickView" data-bs-toggle="modal" title="Quick View">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="compare.html" title="Compare">
                                                    <i class="ri-loop-left-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div>
                                                <div class="brand-w-color">
                                                    <a class="product-title" href="product-page(accordian).html">
                                                        VogueVista
                                                    </a>
                                                </div>
                                                <h6>Chic Crop Top</h6>
                                                <h4 class="price">$ 5.60<del> $6.80 </del><span
                                                        class="discounted-price"> 5%
                                                        Off
                                                    </span>
                                                </h4>
                                            </div>
                                            <ul class="offer-panel">
                                                <li><span class="offer-icon"><i
                                                            class="ri-discount-percent-fill"></i></span>
                                                    Limited Time Offer: 25% off</li>
                                                <li><span class="offer-icon"><i
                                                            class="ri-discount-percent-fill"></i></span>
                                                    Limited Time Offer: 25% off</li>
                                                <li><span class="offer-icon"><i
                                                            class="ri-discount-percent-fill"></i></span>
                                                    Limited Time Offer: 25% off</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="basic-product theme-product-1">
                                    <div class="overflow-hidden">
                                        <div class="img-wrapper">
                                            <a href="product-page(accordian).html"><img
                                                    src="{{asset('assets/images/fashion-1/product/15.jpg')}}"
                                                    class="img-fluid blur-up lazyloaded" alt=""></a>
                                            <div class="rating-label"><i class="fa fa-star"></i>
                                                <span>3.7</span>
                                            </div>
                                            <div class="cart-info">
                                                <a href="#!" title="Add to Wishlist" class="wishlist-icon">
                                                    <i class="ri-heart-line"></i>
                                                </a>
                                                <button data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas"
                                                    title="Add to cart">
                                                    <i class="ri-shopping-cart-line"></i>
                                                </button>
                                                <a href="#quickView" data-bs-toggle="modal" title="Quick View">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="compare.html" title="Compare">
                                                    <i class="ri-loop-left-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div>
                                                <div class="brand-w-color">
                                                    <a class="product-title" href="product-page(accordian).html">
                                                        Urban Chic
                                                    </a>
                                                </div>
                                                <h6>Classic Jacket</h6>
                                                <h4 class="price">$ 3.80 </h4>
                                            </div>
                                            <ul class="offer-panel">
                                                <li><span class="offer-icon"><i
                                                            class="ri-discount-percent-fill"></i></span>
                                                    Limited Time Offer: 10% off</li>
                                                <li><span class="offer-icon"><i
                                                            class="ri-discount-percent-fill"></i></span>
                                                    Limited Time Offer: 10% off</li>
                                                <li><span class="offer-icon"><i
                                                            class="ri-discount-percent-fill"></i></span>
                                                    Limited Time Offer: 10% off</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="basic-product theme-product-1">
                                    <div class="overflow-hidden">
                                        <div class="img-wrapper">
                                            <a href="product-page(image-swatch).html">
                                                <img src="{{asset('assets/images/fashion-1/product/16.jpg')}}"
                                                    class="img-fluid blur-up lazyloaded" alt="">
                                            </a>
                                            <div class="rating-label"><i class="fa fa-star"></i>
                                                <span>8.7</span>
                                            </div>
                                            <div class="cart-info">
                                                <a href="#!" title="Add to Wishlist" class="wishlist-icon">
                                                    <i class="ri-heart-line"></i>
                                                </a>
                                                <button data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas"
                                                    title="Add to cart">
                                                    <i class="ri-shopping-cart-line"></i>
                                                </button>
                                                <a href="#quickView" data-bs-toggle="modal" title="Quick View">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="compare.html" title="Compare">
                                                    <i class="ri-loop-left-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div>
                                                <div class="brand-w-color">
                                                    <a class="product-title" href="product-page(accordian).html">
                                                        Couture Edge
                                                    </a>
                                                </div>
                                                <h6>Versatile Shacket</h6>
                                                <h4 class="price"> $3.00
                                                </h4>
                                            </div>
                                            <ul class="offer-panel">
                                                <li><span class="offer-icon"><i
                                                            class="ri-discount-percent-fill"></i></span>
                                                    Limited Time Offer: 12% off</li>
                                                <li><span class="offer-icon"><i
                                                            class="ri-discount-percent-fill"></i></span>
                                                    Limited Time Offer: 12% off</li>
                                                <li><span class="offer-icon"><i
                                                            class="ri-discount-percent-fill"></i></span>
                                                    Limited Time Offer: 12% off</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Modal End -->


    <!-- Cart Offcanvas Start -->
  

<div class="offcanvas offcanvas-end cart-offcanvas" tabindex="-1" id="cartOffcanvas">
    <div class="offcanvas-header">
        <h3 class="offcanvas-title">My Cart (<span id="cart-count-badge">{{ $items->count() }}</span>) 
        <small class="text-muted">
            Taxes, Discount, and Shipping Charges will be calculated at checkout.
        </small>

        </h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" onclick="closeMadodel()">
            <i class="ri-close-line"></i>
        </button>
    </div>
    <div class="offcanvas-body">

        <ul class="cart-product" id="cart-items-container">
            @foreach($items as $item)
                <li data-id="{{ $item->id }}">
                    <div class="media">
                        <a href="#">
                            <img src="{{ asset('uploads/product/'.$item->product->main_image) }}" class="img-fluid" alt="{{ $item->product->product_name }}">
                        </a>
                        <div class="media-body">
                            <h4>{{ $item->product->product_name }}</h4>
                            <h4 class="quantity">
                                <span class="item-qty">{{ $item->quantity }}</span> x Rs <span class="item-price">{{ $item->product->price }}</span>
                                <p> <span>Shipping Charge : Rs. {{ $item->shipping_charge }}</span></p>
                            </h4>
                            
                            <div class="qty-box">
                                <div class="input-group qty-container">
                                    <button class="btn qty-btn-minus" data-id="{{ $item->id }}">
                                        <i class="ri-subtract-line"></i>
                                    </button>
                                    <input type="number" readonly name="qty" class="form-control input-qty" value="{{ $item->quantity }}">
                                    <button class="btn qty-btn-plus" data-id="{{ $item->id }}">
                                        <i class="ri-add-line"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="close-circle">
                                   
                                    <button class="close_button delete-button" type="button"  onclick="deleteCart({{ $item->id }})">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                            </div>

                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        <ul class="cart_total">
            <li>
                <div class="total">
                    <h5>Sub Total : <span id="cart-subtotal">Rs {{ $cartSubtotal }}</span></h5>
                </div>
            </li>
            <li>
                <div class="buttons">
                    <a href="" class="btn view-cart">View Cart</a>
                    <a href="{{ route('checkout') }}" class="btn checkout">Check Out</a>
                </div>
            </li>
        </ul>
    </div>
</div>

<!-- Cart count badge somewhere in header -->
<span class="cart_qty_cls" id="cart-count-badge">{{ $items->count() }}</span>

    </div>

    <div class="modal fade theme-modal-2 variation-modal" id="variationModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="ri-close-line"></i>
                </button>
                <div class="modal-body">
                    <div class="product-right product-page-details variation-title">
                        <h2 class="main-title">
                            <a href="product-page(accordian).html">Cami Tank Top (Blue)</a>
                        </h2>
                        <h3 class="price-detail">$14.25 <span>5% off</span></h3>
                    </div>
                    <div class="variation-box">
                        <h4 class="sub-title">Color:</h4>
                        <ul class="quantity-variant color">
                            <li class="bg-light">
                                <span style="background-color: rgb(240, 0, 0);"></span>
                            </li>
                            <li class="bg-light">
                                <span style="background-color: rgb(47, 147, 72);"></span>
                            </li>
                            <li class="bg-light active">
                                <span style="background-color: rgb(0, 132, 255);"></span>
                            </li>
                        </ul>
                    </div>
                    <div class="variation-qty-button">
                        <div class="qty-section">
                            <div class="qty-box">
                                <div class="input-group qty-container">
                                    <button class="btn qty-btn-minus">
                                        <i class="ri-subtract-line"></i>
                                    </button>
                                    <input type="number" readonly name="qty" class="form-control input-qty" value="1">
                                    <button class="btn qty-btn-plus">
                                        <i class="ri-add-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="product-buttons">
                            <button class="btn btn-animation btn-solid hover-solid scroll-button"
                                id="replacecartbtnVariation14" type="submit" data-bs-dismiss="modal">
                                <i class="ri-shopping-cart-line me-1"></i>
                                Update Item
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Offcanvas End -->


    <!-- latest jquery-->
    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>

    <!-- portfolio js -->
    <script src="{{asset('assets/js/isotope.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- menu js-->
    <script src="{{asset('assets/js/menu.js')}}"></script>
    <script src="{{asset('assets/js/sticky-menu.js')}}"></script>

    <!-- feather icon js-->
    <script src="{{asset('assets/js/feather.min.js')}}"></script>

    <!-- lazyload js-->
    <script src="{{asset('assets/js/lazysizes.min.js')}}"></script>
     
    <!-- price range js -->
    <script src="{{asset('assets/js/price-range.js')}}"></script>

    <!-- slick js-->
    <script src="{{asset('assets/js/slick.js')}}"></script>
    <script src="{{asset('assets/js/slick-animation.min.js')}}"></script>

    <!-- Bootstrap js-->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Bootstrap Notification js-->
    <script src="{{asset('assets/js/bootstrap-notify.min.js')}}"></script>

    <!-- Theme js-->
    <script src="{{asset('assets/js/theme-setting.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/custom-slick-animated.js')}}"></script>


    <script>
        $(window).on('load', function () {
            setTimeout(function () {
                $('#exampleModal').modal('show');
            }, 2500);
        });

        function openSearch() {
            document.getElementById("search-overlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("search-overlay").style.display = "none";
        }
        feather.replace();
    </script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            const price = this.getAttribute('data-price');
           
            fetch("{{ route('cart.add') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    listing_id: productId,
                    quantity: 1,
                    price: price
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                     $('.cart_qty_cls').html(data.cart_count);
                    // console.log(data.cart_count)
                     if(data.cart_count=='1'){
                        $('#cartOffcanvas').addClass('show');
                     }
                    updateCartUI(data);
                    alert(data.message || 'Added to cart!');
                    
                }else{
                     alert(data.message || 'Item Is Out of Stock');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    // Quantity plus/minus buttons
    document.getElementById('cart-items-container').addEventListener('click', function(e) {
        if(e.target.closest('.qty-btn-plus')) {
            const btn = e.target.closest('.qty-btn-plus');
            const cartItemId = btn.getAttribute('data-id');
            updateQuantity(cartItemId, 1);
        } else if(e.target.closest('.qty-btn-minus')) {
            const btn = e.target.closest('.qty-btn-minus');
            const cartItemId = btn.getAttribute('data-id');
            updateQuantity(cartItemId, -1);
        }
    });

    function updateQuantity(cartItemId, change) {
        fetch('/cart/update-quantity', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                cart_item_id: cartItemId,
                change: change
            })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
               
                updateCartUI(data);
            } else {
                alert(data.message || 'Error updating quantity.');
            }
        })
        .catch(console.error);
    }

    // Update the cart HTML dynamically
    function updateCartUI(data) {
        const container = document.getElementById('cart-items-container');
        container.innerHTML = '';

        data.cart_items.forEach(item => {
            container.innerHTML += `
                <li data-id="${item.id}">
                    <div class="media">
                        <a href="#">
                            <img src="${item.image}" class="img-fluid" alt="${item.name}">
                        </a>
                        <div class="media-body">
                            <h4>${item.name}</h4>
                            <h4 class="quantity">
                                <span class="item-qty">${item.quantity}</span> x Rs <span class="item-price">${item.price}</span>
                                 <p> <span>Shipping Charge : Rs. ${item.shipping_charge}</span></p>
                               
                            </h4>
                            <div class="qty-box">
                                <div class="input-group qty-container">
                                    <button class="btn qty-btn-minus" data-id="${item.id}">
                                        <i class="ri-subtract-line"></i>
                                    </button>
                                    <input type="number" readonly name="qty" class="form-control input-qty" value="${item.quantity}">
                                    <button class="btn qty-btn-plus" data-id="${item.id}">
                                        <i class="ri-add-line"></i>
                                    </button>
                                </div>
                            </div>
                              <div class="close-circle">
                                   
                                    <button class="close_button delete-button" type="button"  onclick="deleteCart(${item.id})">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                            </div>
                        </div>
                    </div>
                </li>
            `;
        });

        document.getElementById('cart-count-badge').innerText = data.cart_count;
        document.getElementById('cart_qty_cls').innerText = data.cart_count;

        document.getElementById('cart-subtotal').innerText = 'Rs ' + data.cart_subtotal;
    }
});

function closeMadodel(){
      $('#cartOffcanvas').removeClass('show');
}

function deleteCart(id){
// alert(id); return false;
            fetch("{{ route('deleteCart') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id: id,
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                   
                    alert(data.message || 'Product Deleted From cart!');

                    $('li[data-id="' + id + '"]').hide();
                    $('#cart-subtotal').html(data.cart_subtotal);
                    $('#cart-count-badge').html(data.cart_count);
                     $('#cart_qty_cls').html(data.cart_count);
                    
                    
                }
            })
          //  .catch(error => console.error('Error:', error));
}
</script>
<script>
    document.getElementById('google-login-btn').addEventListener('click', function () {
    const currentUrl = encodeURIComponent(window.location.href);
    window.location.href = `/auth/google-login?redirect_to=${currentUrl}`;
});
</script>
</body>

</html>