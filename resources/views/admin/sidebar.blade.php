 <!-- Page Body Start-->
 <div class="page-body-wrapper">

<!-- Page Sidebar Start-->
<div class="page-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper">
            <a href="javascript:void(0)">
                <!-- <img class="d-none d-lg-block blur-up lazyloaded"
                    src="assets/images/dashboard/multikart-logo.png" alt=""> -->
                   
            </a>
        </div>
    </div>
    <div class="sidebar custom-scrollbar">
        <a href="javascript:void(0)" class="sidebar-back d-lg-none d-block"><i class="fa fa-times"
                aria-hidden="true"></i></a>
        <ul class="sidebar-menu">
            @admincan(['dashboard-create', 'dashboard-read', 'dashboard-update', 'dashboard-delete'])
            <li>
                <a class="sidebar-header" href="{{route('dashboard')}}">
                    <i data-feather="home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
          @endadmincan
          @admincan(['category-create', 'category-read', 'category-update', 'category-delete'])
            <li>
                <a class="sidebar-header" href="{{route('category')}}">
                    <i data-feather="home"></i>
                    <span>Category</span>
                </a>
            </li>
            @endadmincan
             @admincan(['subcategory-create', 'subcategory-read', 'subcategory-update', 'subcategory-delete'])
            <li>
                <a class="sidebar-header" href="{{route('subcategory')}}">
                    <i data-feather="home"></i>
                    <span>Sub Category</span>
                </a>
            </li>
             @endadmincan
             @admincan(['banner-create', 'banner-read', 'banner-update', 'banner-delete'])
            <li>
                <a class="sidebar-header" href="{{route('banners')}}">
                    <i data-feather="home"></i>
                    <span>Banner</span>
                </a>
            </li>
             @endadmincan
            @admincan(['role-create', 'role-read', 'role-update', 'role-delete'])
            <li>
                <a class="sidebar-header" href="{{route('role')}}">
                    <i data-feather="home"></i>
                    <span>Role</span>
                </a>
            </li>
            @endadmincan
             @admincan(['permission-create', 'permission-read', 'permission-update', 'permission-delete'])
            <li>
                <a class="sidebar-header" href="{{route('permission')}}">
                    <i data-feather="home"></i>
                    <span>Permission</span>
                </a>
            </li>
            @endadmincan
             @admincan(['role-permission-create', 'role-permission-read', 'role-permission-update', 'role-permission-delete'])
             <li>
                <a class="sidebar-header" href="{{route('rolepermission')}}">
                    <i data-feather="home"></i>
                    <span>Role Permission</span>
                </a>
            </li>
             @endadmincan
             @admincan(['brand-create', 'brand-read', 'brand-update', 'brand-delete'])
            <li>
                <a class="sidebar-header" href="{{route('brand')}}">
                    <i data-feather="home"></i>
                    <span>Brand</span>
                </a>
            </li>
             @endadmincan
            @admincan(['measure-create', 'measure-read', 'measure-update', 'measure-delete'])
            <li>
                <a class="sidebar-header" href="{{route('weight')}}">
                    <i data-feather="home"></i>
                    <span>Measure</span>
                </a>
            </li>
             @endadmincan
             @admincan(['product-create', 'product-read', 'product-update', 'product-delete'])
            <li>
                <a class="sidebar-header" href="{{route('product')}}">
                    <i data-feather="home"></i>
                    <span>Products</span>
                </a>
            </li>
             @endadmincan
             @admincan(['stock-location-create', 'stock-location-read', 'stock-location-update', 'stock-location-delete'])
            <li>
                <a class="sidebar-header" href="{{route('stockLocations')}}">
                    <i data-feather="home"></i>
                    <span>Stock Locations </span>
                </a>
            </li>
             @endadmincan
             @admincan(['listing-create', 'listing-read', 'listing-update', 'listing-delete'])
            <li>
                <a class="sidebar-header" href="javascript:void(0)">
                    <i data-feather="archive"></i>
                    <span>Listings</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>

                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('listingproduct')}}">
                            <i class="fa fa-circle"></i>
                            <span>Listing</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('listinglogs')}}">
                            <i class="fa fa-circle"></i>
                            <span>Listing Logs</span>
                        </a>
                    </li>

                </ul>
            </li>
             @endadmincan
             @admincan(['blog-create', 'blog-read', 'blog-update', 'blog-delete'])
            <li>
                <a class="sidebar-header" href="{{route('blog')}}">
                    <i data-feather="home"></i>
                    <span>Blog</span>
                </a>
            </li>
            @endadmincan
           
           @admincan(['bid-create', 'bid-read', 'bid-update', 'bid-delete'])
            <li>
                <a class="sidebar-header" href="{{route('bids')}}">
                    <i data-feather="home"></i>
                    <span>Bids</span>
                </a>
            </li>
             @endadmincan
             @admincan(['order-create', 'order-read', 'order-update', 'order-delete'])
                        <li>
                            <a class="sidebar-header" href="javascript:void(0)">
                                <i data-feather="dollar-sign"></i>
                                <span>Orders</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="{{route('order')}}">
                                        <i class="fa fa-circle"></i>Orders List
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('transaction')}}">
                                        <i class="fa fa-circle"></i>Transactions
                                    </a>
                                </li>
                            </ul>
                        </li>
                         @endadmincan
                         @admincan(['coupon-create', 'coupon-read', 'coupon-update', 'coupon-delete'])
                         <li>
                <a class="sidebar-header" href="{{route('coupon')}}">
                    <i data-feather="home"></i>
                    <span>Coupons</span>
                </a>
            </li>
             @endadmincan
             @admincan(['setting-create', 'setting-read', 'setting-update', 'setting-delete'])
              <li>
                <a class="sidebar-header" href="{{route('setting')}}">
                    <i data-feather="home"></i>
                    <span>Settings</span>
                </a>
            </li>
             @endadmincan
             @admincan(['employee-create', 'employee-read', 'employee-update', 'employee-delete'])
            <li>
                <a class="sidebar-header" href="{{route('employee')}}">
                    <i data-feather="home"></i>
                    <span>Employee</span>
                </a>
            </li>
            @endadmincan

           
            <li>
                <a class="sidebar-header" href="{{ route('admin.messages') }}">
                    <i data-feather="home"></i>
                    <span>Messages</span>
                </a>
            </li>
            <li>
                <a class="sidebar-header" href="{{ route('package') }}">
                    <i data-feather="home"></i>
                    <span>Package</span>
                </a>
            </li>
             <li>
                <a class="sidebar-header" href="{{ route('admin.reviews.index') }}">
                    <i data-feather="home"></i>
                    <span>Reviews</span>
                </a>
            </li>

             @admincan(['cms-update'])
            <li>
                <a class="sidebar-header" href="javascript:void(0)">
                    <i data-feather="archive"></i>
                    <span>Manage CMS</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>

                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.cms.manage') }}">
                            <i class="fa fa-circle"></i>
                            <span>Terms and Condition</span>
                        </a>
                    </li>
                  
                    <li>
                        <a href="{{route('admin.cms.home')}}">
                            <i class="fa fa-circle"></i>
                            <span>Home Page</span>
                        </a>
                    </li>

                </ul>
            </li>

              <li>
                <a class="sidebar-header" href="{{ route('admin.contact_messages_website') }}">
                    <i data-feather="home"></i>
                    <span>Contact Messages</span>
                </a>
            </li>
             <li>
                <a class="sidebar-header" href="{{ route('template') }}">
                    <i data-feather="home"></i>
                    <span>Template</span>
                </a>
            </li>
            <li>
                <a class="sidebar-header" href="{{route('email_template')}}">
                    <i data-feather="home"></i>
                    <span>Email Template</span>
                </a>
            </li>
              <li>
                <a class="sidebar-header" href="{{route('whatsapp-template')}}">
                    <i data-feather="home"></i>
                    <span>Whatsapp Template</span>
                </a>
            </li>
             @endadmincan
           
        </ul>
    </div>
</div>
<!-- Page Sidebar Ends-->