@extends('layout.app')
@section('content')
  <!-- breadcrumb start -->
  <div class="breadcrumb-section">
        <div class="container">
            <h2>Collection</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('/')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Left sidebar</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!-- section start -->
    <section class="section-b-space ratio_asos">
        <div class="collection-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 collection-filter">
                        <!-- side-bar collapse block stat -->
                        <div class="collection-filter-block">
                            <!-- brand filter start -->
                            <button class="collection-mobile-back btn">
                                <span class="filter-back">back</span>
                                <i class="ri-arrow-left-s-line"></i>
                            </button>
                            <div class="collection-collapse-block open">
                                <div class="accordion collection-accordion" id="accordionPanelsStayOpenExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button pt-0" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne"
                                                aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                Categories </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                <ul class="collection-listing">
                                                    @if($data['category'])
                                                    @foreach($data['category'] as $cat)
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input sub_childitem category-filter" type="checkbox" value="{{$cat['categoryId']}}" name="categories[]"
                                                                id="checkbox{{$cat['categoryId']}}">
                                                            <label class="form-check-label" for="checkbox{{$cat['categoryId']}}">
                                                                {{ucfirst($cat['categoryName'])}}
                                                            </label>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                                aria-controls="panelsStayOpen-collapseTwo">
                                                Brand </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                <ul class="collection-listing">
                                                @if(!$data['brand']->isEmpty())
                                                @foreach($data['brand'] as $brand)
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input brand-filter" type="checkbox" value="{{$brand->brandId ?? 0}}"
                                                                id="checkbox1{{$brand->brandId}}" name="brands[]">
                                                            <label class="form-check-label" for="checkbox1{{$brand->brandId}}">
                                                               {{ucfirst($brand->brand_name)}}
                                                            </label>
                                                        </div>
                                                    </li>
                                                   @endforeach
                                                   @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                  
                                   
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false"
                                                aria-controls="panelsStayOpen-collapseSix">
                                                Price </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse show">
                                            <div class="accordion-body price-body">
                                                <div class="wrapper">
                                                    <div class="range-slider">
                                                        <input type="text" class="js-range-slider" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- side-bar collapse block end here -->
                    </div>
                    <div class="collection-content col-xl-9 col-lg-8">
                        <div class="page-main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="top-banner-wrapper">
                                        <a href="#!">
                                            <img src="{{asset('assets/images/inner-page/banner/1.png')}}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>
                                    </div>
                                    <button class="filter-btn btn"><i class="ri-filter-fill"></i> Filter
                                    </button>
                                    <div class="collection-product-wrapper">
                                        <div class="product-top-filter mt-0">
                                            <div class="product-filter-content w-100">
                                                <div class="d-flex align-items-center gap-sm-3 gap-2">
                                                    <select class="form-select position" id="position">
                                                        <option selected>Ascending Order</option>
                                                        <option value="desc">Descending Order</option>
                                                        <option value="low">Low - High Price</option>
                                                        <option value="high">High - Low Price</option>
                                                    </select>

                                                    <!-- <select class="form-select">
                                                        <option selected>10 Products</option>
                                                        <option value="1">25 Products</option>
                                                        <option value="2">50 Products</option>
                                                        <option value="3">100 Products</option>
                                                    </select> -->
                                                </div>


                                                <div class="collection-grid-view">
                                                    <ul>
                                                        <li class="product-2-layout-view grid-icon">
                                                            <img src="{{asset('assets/images/inner-page/icon/2.png')}}" alt="sort"
                                                                class=" ">
                                                        </li>
                                                        <li class="product-3-layout-view grid-icon active">
                                                            <img src="{{asset('assets/images/inner-page/icon/3.png')}}" alt="sort"
                                                                class=" ">
                                                        </li>
                                                        <li class="product-4-layout-view grid-icon">
                                                            <img src="{{asset('assets/images/inner-page/icon/4.png')}}" alt="sort"
                                                                class=" ">
                                                        </li>
                                                        <li class="list-layout-view list-icon">
                                                            <img src="{{asset('assets/images/inner-page/icon/list.png')}}"
                                                                alt="sort" class=" ">
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-wrapper-grid">
                                            <div class="row g-3 g-sm-4" id="productlist">
                                              @include('frontend._products', ['products' => $data['listing']]) 
                                             </div>
                                        </div>
                                        <div class="product-pagination">
                                            <div class="theme-paggination-block" id="pagination-container">
                                                @include('frontend._pagination', ['products' => $data['listing']])
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

    </section>
    <!-- section End -->

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
  
$(document).ready(function() {
    let filterTimeout;
    let selectedCategories = [];
    let selectedBrands = [];
   
    // Initialize filters from URL if present
    function initFiltersFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        
        // Categories
        if (urlParams.has('categories')) {
            selectedCategories = urlParams.get('categories').split(',');
            selectedCategories.forEach(catId => {
                $(`#category-${catId}`).prop('checked', true);
            });
        }
        
        // Brands
        if (urlParams.has('brands')) {
            selectedBrands = urlParams.get('brands').split(',');
            selectedBrands.forEach(brandId => {
                $(`#brand-${brandId}`).prop('checked', true);
            });
        }
        
    }
    
    // Call the initialization function
    initFiltersFromUrl();
    
    // Handle category filter changes
    $('.category-filter').on('change', function() {
        selectedCategories = $('.category-filter:checked').map(function() {
            return this.value;
        }).get();
        
        applyFilters();
    });
    
    // Handle brand filter changes
    $('.brand-filter').on('change', function() {
        selectedBrands = $('.brand-filter:checked').map(function() {
            return this.value;
        }).get();
        
        applyFilters();
    });

     $('.position').on('change', function() {
        applyFilters();
    });
    
    function applyFilters(page = 1) {
        $('#loading').removeClass('d-none');
        
        const params = {
            categories: selectedCategories.join(','),
            brands: selectedBrands.join(','),
            position: $('#position').val(),
            page: page
        };
        
        // Clean up empty parameters
        Object.keys(params).forEach(key => {
            if (!params[key]) delete params[key];
        });
        
        $.ajax({
            url: "{{ route('ajaxFilter') }}",
            type: "GET",
            data: params,
            success: function(response) {
                $('#productlist').html(response.products);
                $('#pagination-container').html(response.pagination);
                
                // Update URL without reloading
                const queryString = '?' + $.param(params);
                history.pushState(null, null, queryString);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            },
            complete: function() {
                $('#loading').addClass('d-none');
            }
        });
    }
    
    // Handle pagination clicks
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        const page = $(this).attr('href').split('page=')[1];
        applyFilters(page);
    });

   


});



</script>