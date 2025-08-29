@extends('layout.app')
@section('content')


 <!-- breadcrumb start -->
 <div class="breadcrumb-section">
        <div class="container">
            <h2>{{$data['listingDetail']->product_name ?? ''}}</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active">{{$data['listingDetail']->product_name ?? ''}}</li>
                </ol>
            
            </nav>
                @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        @endif
        </div>
    </div>
    <!-- breadcrumb End -->


    <!-- section start -->
    <section>
        
        <div class="collection-wrapper">
            <div class="container">
                <div class="collection-wrapper">
                    <div class="row g-4">
                        <div class="col-lg-4">
                     
                            <div class="product-slick">

                            @foreach( $data['listingAsc'] as $bid)
                            <div>
                                <img src="{{asset('uploads/product/'.$bid->main_image)}}" alt=""
                            class="w-100 img-fluid blur-up lazyload">
                        </div>
                            @endforeach
                                <!-- <div><img src="{{asset('assets/images/product-details/product/18.jpg')}}" alt=""
                                        class="w-100 img-fluid blur-up lazyload"></div>
                                <div><img src="{{asset('assets/images/product-details/product/19.jpg')}}" alt=""
                                        class="w-100 img-fluid blur-up lazyload"></div>
                                <div><img src="{{asset('assets/images/product-details/product/18.jpg')}}" alt=""
                                        class="w-100 img-fluid blur-up lazyload"></div> -->
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="slider-nav">
                                 @foreach( $data['listingAsc'] as $bid)
                                    <div><img src="{{asset('uploads/product/'.$bid->main_image)}}" alt=""
                                    class="w-100 img-fluid blur-up lazyload"></div>
                                    @endforeach
                                        <!-- <div><img src="{{asset('assets/images/product-details/product/18.jpg')}}" alt=""
                                                class="img-fluid blur-up lazyload"></div>
                                        <div><img src="{{asset('assets/images/product-details/product/19.jpg')}}" alt=""
                                                class="img-fluid blur-up lazyload"></div>
                                        <div><img src="{{asset('assets/images/product-details/product/18.jpg')}}" alt=""
                                                class="img-fluid blur-up lazyload"></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="product-page-details product-description-box sticky-details mt-0">

                                <div class="trending-text ">
                                    <img src="{{asset('assets/images/product-details/trending.gif')}}" class="img-fluid" alt="">
                                    <h5>Selling fast! 4 people have this in their carts.
                                    </h5>
                                </div>

                                <h2 class="main-title"> {{$data['listingDetail']->product_name ?? ''}} </h2>
                               @php
                                        $avg = number_format($data['ratingStats']['average'] ?? 0, 1); // e.g. 4.2
                                        $total = $data['ratingStats']['total'] ?? 0;
                                    @endphp

                                    <div class="product-rating">
                                        <div class="rating-list">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($avg))
                                                    <i class="ri-star-fill text-warning"></i>
                                                @elseif ($i - $avg < 1)
                                                    <i class="ri-star-half-fill text-warning"></i>
                                                @else
                                                    <i class="ri-star-line text-warning"></i>
                                                @endif
                                            @endfor
                                        </div>

                                        <span class="divider">|</span>
                                        <a href="#!">{{ $total }} Review{{ $total == 1 ? '' : 's' }}</a>
                                    </div>
                               
                                <div class="price-text">
                                    <h3><span class="fw-normal">MRP:</span>
                                        Rs{{$data['listingDetail']['price']}}
                                    </h3><span>Inclusive all the text </span>
                                </div>

                                <div class="size-delivery-info flex-wrap">
                                    <a href="#return" data-bs-toggle="modal" class=""><i class="ri-truck-line"></i>
                                        Delivery &amp; Return </a>

                                    <a href="#ask-question" class="" data-bs-toggle="modal"><i
                                            class="ri-questionnaire-line"></i>
                                        Ask a Question </a>

                                </div>


                                <div class="accordion accordion-flush product-accordion" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                                Product Description </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p>{{$data['listingDetail']['description']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                                aria-controls="flush-collapseTwo">
                                                Information </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse show"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <div class="bordered-box border-0 mt-0 pt-0">
                                                    <h4 class="sub-title">
                                                        product Info</h4>
                                                    <ul class="shipping-info">
                                                        <!-- <li><span>SKU: </span>SP18
                                                            (COPY) </li> -->

                                                        <li><span>Unit: </span>1
                                                            Item </li>

                                                        <li><span>Weight:
                                                            </span>{{$data['listingDetail']['weightId']}} </li>

                                                        <li><span>Stock Status:
                                                            </span>In stock </li>

                                                        <li><span>Quantity:
                                                            </span>{{$data['listingDetail']['quantity']}}</li>
                                                    <li><span>Height:
                                                            </span>{{$data['listingDetail']['height']}} </li>
                                                    <li><span>Breadth:
                                                            </span>{{$data['listingDetail']['breadth']}} </li>
                                                    <li><span>Lenght:
                                                    </span>{{$data['listingDetail']['length']}} </li>
                                                            
                                                    </ul>
                                                </div>

                                                <div class="bordered-box">
                                                    <h4 class="sub-title">
                                                        Delivery Details</h4>
                                                    <ul class="delivery-details">
                                                        <li><i class="ri-truck-line"></i> Your order is
                                                            likely to reach you within 7 days. </li>

                                                        <li><i class="ri-arrow-left-right-line"></i>
                                                            Hassle free returns within 7 Days. </li>
                                                    </ul>
                                                </div>

                                                <div class="dashed-border-box mb-0">
                                                    <h4 class="sub-title">Guaranteed Safe Checkout</h4>
                                                    <img class="img-fluid payment-img" alt=""
                                                        src="{{asset('assets/images/product-details/payments.png')}}">
                                                </div>

                                                <div class="dashed-border-box mb-0">
                                                    <h4 class="sub-title">Secure Checkout</h4>
                                                    <img class="img-fluid payment-img" alt=""
                                                        src="{{asset('assets/images/product-details/secure_payments.png')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                            <div class="card shadow-lg">
                                <h4 class="sub-title">Place a Bid  </h4>
                                <span id="message" style="color:green"></span>
                                <div class="form-group mt-2">
                                   
                                @php
                                    $bidAmount = !empty($data['latestAmount']) ? $data['latestAmount'] :'0';
                                @endphp

                                    <label for="bid_amount">Bid Amount {{ $data['listingDetail']['type'] == 'sale' ? ' (min: ' . $bidAmount . ')' : '' }}</label>
                                    <input type="number" class="form-control" name="bid_amount" id="bid_amount" autocomplete="off">
                                    <input type="hidden" class="form-control" name="listiD" id="listiD" value="{{$data['listingDetail']['id']}}">
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control" name="quantity" id="quantity" data-product-id="{{$data['listingDetail']['id']}}" autocomplete="off">
                                    <small id="quantity-warning" class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" id="placeBidBtn">Place Bid</button>
                                </div>
                                
                                <div class="card mt-3">
                                <h4 class="sub-title">Your Bid History</h4>
                                <table class="table table-striped">
                                <thead>
                                    <th>Amount</th>
                                    <th>Quantity</th>
                                    <th>Counter Amount</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </thead>
                                    <tbody id="bidHistory">
                                        @forelse($data['bids'] as $bid)
                                        <tr id="bid-row-{{ $bid->id }}">
                                            <td style="{{ $bid->status=='countered' ? 'text-decoration:line-through;color:red;':'' }}">{{ $bid->amount }}</td>
                                            <td>{{ $bid->quantity }}</td>
                                            <td>{{ $bid->counter_offer_amount ?? '' }}</td>
                                            <td>{{ $bid->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                @if($bid->status === 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif($bid->status === 'countered')
                                                    <i class="fas fa-check text-success mx-2 cursor-pointer"
                                                    id="accept-icon-{{ $bid->bidId }}"
                                                    title="Counter Accept"
                                                    onclick="handleBidAction({{ $bid->bidId }}, 'countered_approved', this)"></i>

                                                    <i class="fas fa-times text-danger cursor-pointer"
                                                    id="reject-icon-{{ $bid->bidId }}"
                                                    title="Counter Reject"
                                                    onclick="handleBidAction({{ $bid->bidId }}, 'countered_rejected', this)"></i>
                                                @else
                                                    {{-- Final state: already accepted or rejected --}}
                                                    <i class="fas fa-{{ $bid->status === 'countered_approved' ? 'check' : 'times' }} text-{{ $bid->status === 'countered_approved' ? 'success' : 'danger' }}" 
                                                    style="opacity: 0.5;" data-toggle="tooltip" data-placement="top"
                                                    title="{{ $bid->status }} {{ $bid->counter_response_time }}">
                                                    </i>
                                                @endif
                                            </td>
                                          
                                        </tr>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center"></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                </div>
                            </div>

                            <div class="product-page-details product-form-box product-right-box d-flex
                                align-items-center flex-column my-0">
                                <h4 class="sub-title">Colour:</h4>
                                <div class="variation-box size-box">
                                    <ul class="image-box image">
                                        <li class="active">
                                            <a>
                                                <img src="{{asset('assets/images/product-details/product/17.jpg')}}" alt="">
                                            </a>
                                        </li>

                                        <li>
                                            <a>
                                                <img src="{{asset('assets/images/product-details/product/20.jpg')}}" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <img src="{{asset('assets/images/product-details/product/21.jpg')}}" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="product-buttons">
                                    <div class="qty-section">
                                        <div class="qty-box">
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                    <button type="button" class="btn quantity-left-minus"
                                                        data-type="minus" data-field="">
                                                        <i class="ri-arrow-left-s-line"></i>
                                                    </button>
                                                </span>
                                                <input type="text" name="quantity" class="form-control input-number"
                                                    value="1">
                                                <span class="input-group-prepend">
                                                    <button type="button" class="btn quantity-right-plus"
                                                        data-type="plus" data-field="">
                                                        <i class="ri-arrow-right-s-line"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-buttons">
                                    <div class="d-flex align-items-center gap-3">
                                        <button class="btn btn-animation btn-solid hover-solid scroll-button disabled"
                                            type="button"> Out Of Stock
                                        </button>
                                        @if(Auth::check())
                                        <a href="#" class="btn btn-solid buy-button add-to-cart-btn"  data-product-id="{{ $data['listingDetail']['id'] }}" 
                                            data-price="{{ $data['listingDetail']['price'] }}">Add To Cart </a>
                                            @else
                                             <a href="{{route('authlogin')}}" class="btn btn-solid buy-button add-to-cart-btn" >Add To Cart </a>
                                            @endif
                                        
                                    </div>
                                </div>

                                <div class="left-progressbar w-100">
                                  <a href="#" class="btn btn-info" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#sendMessageModal" 
                                    data-product-id="{{ $data['listingDetail']['id'] }}" 
                                    data-seller-id="{{ $data['listingDetail']['sellerId'] }}">
                                    Send Message
                                    </a>
                                    <h6>Please Hurry Only 10 Left In Stock</h6>
                                    <div role="progressbar" class="progress">
                                        <div class="progress-bar" style="width: 100%;">
                                        </div>
                                    </div>
                                </div>

                                <div class="buy-box justify-content-center gap-3">
                                    <a href="#!">
                                        <i class="ri-heart-line"></i>
                                        <span>Add To Wishlist</span>
                                    </a>

                                    <a href="#!" class="add-compare">
                                        <i class="ri-refresh-line"></i>
                                        <span>Add To Compare</span>
                                    </a>

                                    <a href="#share" data-bs-toggle="modal">
                                        <i class="ri-share-line"></i>
                                        <span>Share</span>
                                    </a>
                                </div>
                            </div>

                            
                        </div>

                  

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->


    <!-- product-tab starts -->
    <section class="tab-product m-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab"
                                href="#top-home" role="tab" aria-selected="true"><i
                                    class="icofont icofont-ui-home"></i>Description</a>
                        </li>

                        <li class="nav-item"><a class="nav-link" id="review-top-tab" data-bs-toggle="tab"
                                href="#top-review" role="tab" aria-selected="false"><i
                                    class="icofont icofont-contacts"></i>Review</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab"
                                href="#top-contact" role="tab" aria-selected="false"><i
                                    class="icofont icofont-contacts"></i>Q & A</a>
                        </li>
                    </ul>
                    <div class="tab-content nav-material" id="top-tabContent">
                        <div class="tab-pane fade show active" id="top-home" role="tabpanel"
                            aria-labelledby="top-home-tab">
                            <div class="product-tab-description">
                                <div class="part">
                                    <p>{{$data['listingDetail']->description}}</p>
                                </div>
                               
                            </div>
                        </div>


                        <div class="tab-pane fade" id="top-review" role="tabpanel" aria-labelledby="review-top-tab">
                            <div class="single-product-tables">
                                <div class="row g-3 w-100">
                                   <div class="col-xl-5">
    <div class="product-rating-box">
        <div class="row">
            <div class="col-xl-12">
                <div class="d-flex align-items-center gap-2">
                    <h2 class="mb-0 rating-number">{{ $data['ratingStats']['average'] }}</h2>
                    <div>
                        <span class="base-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= round($data['ratingStats']['average']))
                                    <i class="ri-star-s-fill"></i>
                                @else
                                    <i class="ri-star-s-line"></i>
                                @endif
                            @endfor
                        </span>
                        <h4 class="rating-count">Based on {{ $data['ratingStats']['total'] }} Rating{{ $data['ratingStats']['total'] > 1 ? 's' : '' }}</h4>
                    </div>
                </div>

                <div class="review-title-2">
                    <h4>Review this product</h4>
                    <p>Let other customers know what you think</p>
                    <ul class="product-rating-list">
                        @foreach([5, 4, 3, 2, 1] as $star)
                            <li>
                                <div class="rating-product">
                                    <h5>{{ $star }}<i class="ri-star-fill"></i></h5>
                                    <div class="progress" role="progressbar" aria-valuenow="{{ $data['ratingStats']['breakdown'][$star]['percent'] }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: {{ $data['ratingStats']['breakdown'][$star]['percent'] }}%">
                                        </div>
                                    </div>
                                    <h5 class="total">{{ $data['ratingStats']['breakdown'][$star]['count'] }}</h5>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <button class="btn" data-bs-toggle="modal" data-bs-target="#write-review" type="submit">
                        Write Review
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
                                  <div class="col-xl-7">
                                        <div class="review-people">
                                            <ul class="review-list">
                                                @forelse ($data['reviews'] as $review)
                                                    <li>
                                                        <div class="people-box">
                                                            <div>
                                                                <div class="people-image people-text">
                                                                    <div class="user-round">
                                                                        <h4>{{ strtoupper(substr($review->reviewer_name, 0, 1)) }}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="people-comment">
                                                                <div class="people-name">
                                                                    <a href="#!" class="name">{{ $review->reviewer_name }}</a>
                                                                    <h6 class="text-content">{{ date('d M Y h:i A', strtotime($review->created_at)) }}</h6>
                                                                    <ul class="product-rating">
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <li class="star-rating">
                                                                                @if ($i <= $review->rating)
                                                                                    <i class="ri-star-fill"></i>
                                                                                @else
                                                                                    <i class="ri-star-line"></i>
                                                                                @endif
                                                                            </li>
                                                                        @endfor
                                                                    </ul>
                                                                </div>
                                                                <div class="reply">
                                                                    <p>"{{ $review->content }}"</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li><p>No reviews yet for this product.</p></li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                            <div class="post-question-box">
                                <h4>Have Doubts Regarding This Product ? <a href="#ask-question"
                                        data-bs-toggle="modal">Post
                                        Your Question</a>
                                </h4>
                            </div>
                            <div class="question-answer">
                                <ul>
                                    <li>
                                        <div class="question-box">
                                            <h5>Q1</h5>
                                            <h6 class="font-weight-bold que">Does
                                                the dress offer any UV
                                                protection?</h6>
                                            <ul class="link-dislike-box">
                                                <li><a href="#!"><span><i class="ri-thumb-up-fill"></i>
                                                            0</span></a></li>
                                                <li><a href="#!"><span><i class="ri-thumb-down-fill"></i>
                                                            0</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="answer-box">
                                            <div class="answer-box">
                                                <h5>A1</h5>
                                                <p class="ans">Yes, the dress
                                                    offers UV protection. It blocks
                                                    harmful UV rays, providing an additional layer of sun
                                                    safety. </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="question-box">
                                            <h5>Q2</h5>
                                            <h6 class="font-weight-bold que">Are
                                                there any pockets, and if so,
                                                how many and where are they located?</h6>
                                            <ul class="link-dislike-box">
                                                <li><a href="#!"><span><i class="ri-thumb-up-fill"></i>
                                                            0</span></a></li>
                                                <li><a href="#!"><span><i class="ri-thumb-down-fill"></i>
                                                            0</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="answer-box">
                                            <div class="answer-box">
                                                <h5>A2</h5>
                                                <p class="ans">Yes, there are
                                                    pockets. There are two pockets,
                                                    one on each side of the garment. </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="question-box">
                                            <h5>Q3</h5>
                                            <h6 class="font-weight-bold que">Is the
                                                fabric breathable and
                                                quick-drying?</h6>
                                            <ul class="link-dislike-box">
                                                <li><a href="#!"><span><i class="ri-thumb-up-fill"></i>
                                                            0</span></a></li>
                                                <li><a href="#!"><span><i class="ri-thumb-down-fill"></i>
                                                            0</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="answer-box">
                                            <div class="answer-box">
                                                <h5>A3</h5>
                                                <p class="ans">Yes, the fabric is
                                                    breathable, allowing for
                                                    excellent airflow. Additionally, it is quick-drying,
                                                    ensuring comfort during and after
                                                    activities. </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product-tab ends -->

    <!-- related products -->
    <section class="section-b-space ratio_asos">
        <div class="container">
            <div class="row">
                <div class="col-12 product-related">
                    <h2>related products</h2>
                </div>
            </div>

            <div class="product-5 product-m no-arrow">
                @if($data['relatedProducts'])
                        @foreach($data['relatedProducts'] as $item)
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
                                                                    $avg = number_format($item->avg_rating ?? 0, 1);
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
                                                                        <input type="text" name="product_id" id="listiD" value="{{$item->id}}" hidden>
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

                                                                    <button 
                                                                        class="add-to-cart-btn" 
                                                                        data-product-id="{{ $item['id'] }}" 
                                                                        data-price="{{ $item['price'] }}"
                                                                    >
                                                                        <i class="ri-shopping-cart-line"></i> Add to cart
                                                                    </button>
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

            </div>
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

   <div class="modal fade question-answer-modal theme-modal-2" id="write-review" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="fw-semibold">Write A Review</h3>
                <button class="btn btn-close" type="button" data-bs-dismiss="modal">
                    <i class="ri-close-line"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="reviewForm">
                    <input type="hidden" name="product_id" id="product_id" value="{{$data['listingDetail']->id ?? ''}}"> <!-- set actual product ID -->
                    <input type="hidden" name="rating" id="selected-rating" value="0">

                    <div class="product-wrapper mb-3">
                        <div class="product-image">
                           
                               
                                    <img src="{{asset('uploads/product/'.$data['listingAsc'][2]->main_image)}}" alt=""
                                    class="img-fluid" alt="Product Image">
                                  
                           
                        </div>
                        <div class="product-content">
                            <h5 class="name">{{$data['listingDetail']->product_name ?? ''}}</h5>
                            <div class="product-review-rating mt-2">
                                <div class="product-rating d-flex align-items-center gap-2">
                                    <h6 class="price-number">Rating</h6>
                                    <span class="star-rating d-flex align-items-center" style="cursor:pointer;">
                                        <i class="ri-star-s-line" data-value="1"></i>
                                        <i class="ri-star-s-line" data-value="2"></i>
                                        <i class="ri-star-s-line" data-value="3"></i>
                                        <i class="ri-star-s-line" data-value="4"></i>
                                        <i class="ri-star-s-line" data-value="5"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="review-box form-box mt-3">
                        <label for="content1" class="form-label">Review Content</label>
                        <textarea id="content1" rows="3" class="form-control" placeholder="Write your review here..."></textarea>
                    </div>

                    <div class="modal-footer mt-3">
                        <button class="btn btn-outline" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-solid" type="button" id="submitReviewBtn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="sendMessageModal" tabindex="-1" aria-labelledby="sendMessageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="sendMessageForm" method="POST" action="{{ route('messages.send') }}">
      @csrf
      <input type="hidden" name="product_id" id="modal_product_id">
      <input type="hidden" name="seller_id" id="modal_seller_id">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="sendMessageModalLabel">Send Message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="message_text" class="form-label">Your Message</label>
            <textarea class="form-control" name="message" id="message_text" rows="4" required></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Send Message</button>
        </div>
      </div>
    </form>
  </div>
</div>
    </section>
    <!-- related products -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
document.getElementById('placeBidBtn').addEventListener('click', function () {
    const bidAmount = document.getElementById('bid_amount').value;
    const quantity = document.getElementById('quantity').value;
    
    const listiD = document.getElementById('listiD').value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/place-bid', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            bid_amount: bidAmount,
            quantity: quantity,
            listiD: listiD
        })
    })
    .then(res => res.json())
    .then(data => {
        // console.log(data); return false;
        if (data.success=='success') {
            $('#message').html('<div class="alert alert-success">Thank you! Your bid has been submitted.</div>');

            document.getElementById('bid_amount').value ='';
            document.getElementById('quantity').value ='';
            const row = `<tr>
                <td>${data.bid.amount}</td>
                <td>${data.bid.quantity}</td>
                <td>${data.bid.counter_offer_amount}</td>
                <td>${data.bid.time}</td>
                <td>${data.bid.status}</td>
            </tr>`;
            document.getElementById('bidHistory').insertAdjacentHTML('afterbegin', row);
        }
        else if(data.success=='failed'){
            $('#message').html('<div class="alert alert-danger">You currently have a pending bid for this product. Please wait for it to be processed before placing another.</div>');
        }
        else if(data.success=='Insufficient'){
            $('#message').html('<div class="alert alert-danger">Insufficient amount in wallet.</div>');
        }
        else if(data.success=='quantityExceed'){
            $('#message').html('<div class="alert alert-danger">You can do bid for '+data.avail_quantity+' Quantity Only</div>');
        
        }else  if(data.success=='lessAmount'){
            $('#message').html('<div class="alert alert-danger">Bidding Amount should be  '+data.validAmount+' or more </div>');
        
        }else{
            alert('Error: ' + data.message);
        }
    })
    .catch(err => console.error(err));
});

$(document).ready(function () {
        $('#quantity').on('input', function () {
            let enteredQuantity = parseInt($(this).val());
            let productId = $(this).data('product-id');

            if (!enteredQuantity || enteredQuantity <= 0) {
                $('#quantity-warning').text('');
                return;
            }

            $.ajax({
                url: '/check-quantity/' + productId,
                method: 'GET',
                success: function (response) {
                    let available = response.available_quantity;
                    if (enteredQuantity > available) {
                        $('#quantity-warning').text('Only ' + available + ' quantity you can enter.');
                        $('#placeBidBtn').attr('disabled',true);
                    } else {
                        $('#placeBidBtn').attr('disabled',false);
                        $('#quantity-warning').text('');
                    }
                },
                error: function () {
                    $('#quantity-warning').text('Error checking quantity.');
                }
            });
        });
    });


</script>
<!-- <script>
    function handleBidAction(bidId, actionType, element) {
        if (!confirm('Are you sure you want to ' + actionType.replace('_', ' ') + ' this bid?')) return;

        fetch(`/bids/${bidId}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status: actionType })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('HTTP error ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const now = new Date();
                const formatted = now.toISOString().slice(0, 16).replace('T', ' ');

                // Disable the clicked icon
                element.style.pointerEvents = 'none';
                element.style.opacity = 0.5;
                element.title = 'Responded at ' + formatted;

                // Update the response time cell if needed
                const row = element.closest('tr');
                const responseTimeCell = row.querySelector('td:nth-child(5)');
                if (responseTimeCell) {
                    responseTimeCell.innerText = formatted;
                }
            } else {
                alert(data.message || 'Server error occurred.');
            }
        })
        .catch(error => {
            console.error('AJAX error:', error);
            alert('AJAX error: ' + error.message);
        });
    } -->
<!-- </script> -->
<script>
    function handleBidAction(bidId, actionType, element) {
        if (!confirm('Are you sure you want to ' + actionType.replace('_', ' ') + ' this bid?')) return;

        fetch(`/bids/${bidId}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status: actionType })
        })
        .then(response => {
            if (!response.ok) throw new Error('HTTP error ' + response.status);
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const now = new Date();
                const formatted = now.toISOString().slice(0, 16).replace('T', ' ');

                const row = element.closest('tr');
                const statusCell = row.querySelector('td:nth-child(4)');

                if (statusCell) {
                    const icon = actionType.includes('approved') ? 'check' : 'times';
                    const color = actionType.includes('approved') ? 'success' : 'danger';
                    const title = actionType.includes('approved') ? 'Accepted' : 'Rejected';

                    statusCell.innerHTML = `
                        <i class="fas fa-${icon} text-${color}" 
                        style="opacity: 0.5;" 
                        title="${title} at ${formatted}"></i>
                    `;
                }
            } else {
                alert(data.message || 'Server error occurred.');
            }
        })
        .catch(error => {
            console.error('AJAX error:', error);
            alert('AJAX error: ' + error.message);
        });
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const stars = document.querySelectorAll(".rating-stars .star");
        const ratingInput = document.getElementById("selected-rating");

        let selectedRating = 0;

        stars.forEach((star) => {
            star.addEventListener("mouseover", function () {
                highlightStars(this.dataset.value);
            });

            star.addEventListener("click", function () {
                selectedRating = this.dataset.value;
                ratingInput.value = selectedRating;
                highlightStars(selectedRating);
            });

            star.addEventListener("mouseout", function () {
                highlightStars(selectedRating);
            });
        });

        function highlightStars(rating) {
            stars.forEach((star) => {
                const starValue = star.dataset.value;
                if (starValue <= rating) {
                    star.classList.remove("ri-star-s-line");
                    star.classList.add("ri-star-fill");
                } else {
                    star.classList.add("ri-star-s-line");
                    star.classList.remove("ri-star-fill");
                }
            });
        }
    });
</script>

<!-- Optional CSS (optional but improves UX) -->
<style>
    .star {
        font-size: 24px;
        color: #ffc107;
        cursor: pointer;
        transition: color 0.2s;
    }

    .form-box textarea {
        resize: none;
    }

    .modal-footer .btn {
        min-width: 100px;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star-rating i");
    const ratingInput = document.getElementById("selected-rating");

    // ⭐ Handle star selection
    stars.forEach(star => {
        star.addEventListener("click", function () {
            const rating = this.getAttribute("data-value");
            ratingInput.value = rating;

            // Fill selected stars and unfill the rest
            stars.forEach(s => {
                if (s.getAttribute("data-value") <= rating) {
                    s.classList.remove("ri-star-s-line");
                    s.classList.add("ri-star-fill");
                } else {
                    s.classList.remove("ri-star-fill");
                    s.classList.add("ri-star-s-line");
                }
            });
        });
    });

    // 📝 Handle submit
    document.getElementById("submitReviewBtn").addEventListener("click", function () {
        const rating = ratingInput.value;
        const content = document.getElementById("content1").value.trim();
        const product_id = document.getElementById("product_id").value;

        if (rating === "0" || !content) {
            alert("Please select a rating and write your review.");
            return;
        }

        fetch("{{ route('reviews.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                rating: parseInt(rating),
                content: content,
                product_id: product_id
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert("Review submitted successfully!");
                document.getElementById("reviewForm").reset();
                ratingInput.value = "0";

                // Reset stars
                stars.forEach(s => {
                    s.classList.remove("ri-star-fill");
                    s.classList.add("ri-star-s-line");
                });

                // Hide modal
                const modalEl = document.getElementById("write-review");
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (modalInstance) modalInstance.hide();
            } else {
                alert("Rewiew Already exists for this product.");
            }
        })
        .catch(error => {
            console.error("Error submitting review:", error);
            alert("Something went wrong. Try again.");
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const sendMessageModal = document.getElementById('sendMessageModal');

    sendMessageModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const productId = button.getAttribute('data-product-id');
        const sellerId = button.getAttribute('data-seller-id');

        document.getElementById('modal_product_id').value = productId;
        document.getElementById('modal_seller_id').value = sellerId;
    });
});
</script>
@endsection
