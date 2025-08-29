@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>View Listing
                                       
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Digital</li>
                                    <li class="breadcrumb-item active">Add Product</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row product-adding">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5><a href="{{route('listingproduct')}}" class="btn btn-sm btn-info">Back</a></h5>
                                </div>
                                <div class="card-body">
                                    <div class="digital-add needs-validation">
                                        <div class="row">
                                        <div class="col-md-4"><h5>Category</h5></div>
                                        <div class="col-md-1"> : </div>
                                        <div class="col-md-7"><label>{{ !empty($listingProduct['categoryName']) ? ucwords($listingProduct['categoryName']) : 'N/A' }}</label></div>

                                        <div class="col-md-4"><h5>Sub Category</h5></div>
                                        <div class="col-md-1"> : </div>
                                        <div class="col-md-7"><label>{{ucwords($listingProduct['subcategory_name'])}}</label></div>

                                        <div class="col-md-4"><h5>Product</h5></div>
                                        <div class="col-md-1"> : </div>
                                        <div class="col-md-7"><label>{{ucwords($listingProduct['product_name'])}}</label></div>

                                        <div class="col-md-4"><h5>Type</h5></div>
                                        <div class="col-md-1"> : </div>
                                        <div class="col-md-7"><label>{{ucwords($listingProduct['type'])}}</label></div>

                                        <div class="col-md-4"><h5>Sale Type</h5></div>
                                        <div class="col-md-1"> : </div>
                                        <div class="col-md-7"><label>{{($listingProduct['sale_type']=='1') ? 'Single Pieces':'Whole Sells'}}</label></div>

                                        <div class="col-md-4"><h5>Quality</h5></div>
                                        <div class="col-md-1"> : </div>
                                        <div class="col-md-7"><label>{{$listingProduct['quality']}}</label></div>

                                        <div class="col-md-4"><h5>Estimated Purchase Date</h5></div>
                                        <div class="col-md-1"> : </div>
                                        <div class="col-md-7"><label>{{date('d M Y',strtotime($listingProduct['estimated_purchasedate']))}}</label></div>
                                        @php
                     $valueField = json_decode($listingProduct['additional_fields'] ?? '{}', true); 
                                @endphp

    @foreach($valueField as $fieldName => $fieldValue)
        @php
            $value = is_array($fieldValue) ? ($fieldValue[0] ?? '') : $fieldValue;
        @endphp

        <div class="col-md-4"><h5>{{ ucwords(str_replace('_', ' ', $fieldName)) }}</h5></div>
        <div class="col-md-1"> : </div>
        <div class="col-md-7"><label>{{ old($fieldName, $value) }}</label></div>
    @endforeach

                                    <div class="col-md-4"><h5>Quantity</h5></div>
                                        <div class="col-md-1"> : </div>
                                        <div class="col-md-7"><label>{{$listingProduct['quantity']}}</label></div>

                                        <div class="col-md-4"><h5>Price</h5></div>
                                        <div class="col-md-1"> : </div>
                                        <div class="col-md-7"><label>{{$listingProduct['price']}}</label></div>

                                        <div class="col-md-4"><h5>Currency</h5></div>
                                        <div class="col-md-1"> : </div>
                                        <div class="col-md-7"><label>Rs</label></div>

                                        <div class="col-md-4"><h5>Item Condition</h5></div>
                                        <div class="col-md-1"> : </div>
                                        <div class="col-md-7"><label>{{ucwords($listingProduct['item_condition'])}}</label></div>

                                        <div class="col-md-4"><h5>Status</h5></div>
                                        <div class="col-md-1"> : </div>
                                        <div class="col-md-7"><label>{{ucwords($listingProduct['status'])}}</label></div>

                                        <div class="col-md-4"><h5>Description</h5></div>
                                        <div class="col-md-1"> : </div>
                                        <div class="col-md-7"><label>{{$listingProduct['description']}}</label></div>

                                        <div class="col-md-4"><h5>Main Image</h5></div>
                                        <div class="col-md-1"> : </div>
                                        <div class="col-md-7"><label>
                        <img src="{{asset('uploads/product/'.$listingProduct['main_image'])}}" class="img-fluid" width="100px" height="100px">
                                        </label></div>

                                        
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>List of Bids</h5>
                                </div>
                                <div class="card-body order-datatable">
                               
                                    <table class="display basic-1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Bid Amount</th>
                                                <th>Quantity Requested</th> 
                                                <th>Status</th>
                                                <th>Bid Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                        </tbody>
                                    </table>
                                
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Order Listing</h5>
                                </div>
                                <div class="card-body order-datatable">
                                <table class="display basic-1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Amount</th>
                                                <th>Quantity</th> 
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>

@endsection

