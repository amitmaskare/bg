 @if($products)
                        @foreach($products as $item)
                        <div class="col-xl-4 col-6 col-grid-box">
                                                    <div class="basic-product theme-product-1">
                                                        <div class="overflow-hidden">
                                                            <div class="img-wrapper">
                                                                <a href="{{route('shopdetail',['id' => $item['id']])}}">
                                                                @if($item['main_image'] && file_exists(public_path('uploads/product/'.$item['main_image'])))
                                                                    <img src="{{asset('uploads/product/'.$item['main_image'])}}"
                                                                        class="w-100 img-fluid blur-up lazyload" alt="" style="height:270px !important;">
                                                                        @else
                                                                        <img src="{{asset('assets/images/fashion-1/product/5.jpg')}}"
                                                                        class="w-100 img-fluid blur-up lazyload" alt="" style="height:270px !important;">
                                                                        @endif
                                                                </a>
                                                              @php
                                                                $avg = number_format($item->avg_rating ?? 0, 1); // 1 decimal like 4.5
                                                            @endphp

                                                            <div class="rating-label">
                                                                <i class="ri-star-fill text-warning"></i>
                                                                <span>{{ $avg }}</span>
                                                            </div>
                                                                <div class="cart-info">
                                                                    <button onclick="addwishList({{$item['id']}})" title="Add to Wishlist"
                                                                        class="wishlist-icon">
                                                                        <i class="ri-heart-line"></i>
                                                                    </button>
                                                                    <button class="add-to-cart-btn" 
                                                                     data-product-id="{{ $item['id'] }}" 
                                                                         data-price="{{ $item['price'] }}"
                                                                    title="Add to cart">
                                                                        <i class="ri-shopping-cart-line"></i>
                                                                    </button>
                                                                    <a href="#quickView" data-bs-toggle="modal"
                                                                        title="Quick View">
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
                                                                        <a class="product-title"
                                                                            href="{{route('shopdetail',['id' => $item['id']])}}">
                                                                           {{$item->product_name ?? ''}}
                                                                        </a>
                                                                         <div class="color-panel">
                                                                          
                                                                            <span>Listing Id : {{$item->id}}</span>
                                                                        </div> 
                                                                    </div>
                                                                   
                                                                    <h4 class="price">$ {{$item['price']}}<del> rs{{$item['mrp'] ?? 0}} </del><span
                                                                            class="discounted-price"> {{$item['discount'] ?? 0}}% Off
                                                                        </span>
                                                                    </h4>


                                                            <div class="product-action">
                                                               
                                                                @php
                                                                    $isSeller = Auth::check() && $item['sellerId'] == Auth::id();
                                                                @endphp

                                                                @if (Auth::check())
                                                                    <a 
                                                                        href="{{ $isSeller ? 'javascript:void(0)' : route('shopdetail', ['id' => $item['id']]) }}" 
                                                                        title="Add to bid" 
                                                                        style="font-size:inherit; background-color:#f8f8f8; font-weight:200; padding:8px 14px; gap:5px; color:#222; {{ $isSeller ? 'pointer-events: none; opacity: 0.5;' : '' }}"
                                                                    >
                                                                        <i class="fa fa-gavel"></i>Bid price
                                                                    </a>

                                                                    <button 
                                                                        class="add-to-cart-btn" 
                                                                        data-product-id="{{ $item['id'] }}" 
                                                                        data-price="{{ $item['price'] }}" 
                                                                        {{ $isSeller ? 'disabled style=opacity:0.5;cursor:not-allowed;' : '' }}
                                                                    >
                                                                        <i class="ri-shopping-cart-line"></i> Add to cart
                                                                    </button>
                                                                @else
                                                                    <a 
                                                                        href="{{ route('authlogin') }}" 
                                                                        title="Add to bid" 
                                                                        style="font-size:inherit; background-color:#f8f8f8; font-weight:200; padding:8px 14px; gap:5px; color:#222;"
                                                                    >
                                                                        <i class="fa fa-gavel"></i>Bid price
                                                                    </a>

                                                                    <a 
                                                                        href="{{ route('authlogin') }}" 
                                                                        title="Add to bid" 
                                                                        style="font-size:inherit; background-color:#f8f8f8; font-weight:200; padding:8px 14px; gap:5px; color:#222;"
                                                                    >
                                                                        <i class="ri-shopping-cart-line"></i> Add to cart
                                                                                </a>
                                                                @endif
                                                            </div>
                                                                </div>
                                                                
                                                                <ul class="offer-panel">
                                                                    <li><span class="offer-icon"><i
                                                                                class="ri-discount-percent-fill"></i></span>
                                                                        Limited Time Offer: {{$item['offer'] ?? 0}}% off</li>
                                                                    <li><span class="offer-icon"><i
                                                                                class="ri-discount-percent-fill"></i></span>
                                                                        Limited Time Offer: {{$item['offer'] ?? 0}}% off</li>
                                                                    <li><span class="offer-icon"><i
                                                                                class="ri-discount-percent-fill"></i></span>
                                                                        Limited Time Offer: {{$item['offer'] ?? 0}}% off</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif