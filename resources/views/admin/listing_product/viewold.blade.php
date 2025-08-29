@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>View Listing Products
                                       
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="javascript:void(0)">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Listing Product</li>
                                    <li class="breadcrumb-item active">View Listing Product</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <form action="{{url('listingproduct/updateStatus')}}" method="post" enctype="multipart/form-data">
                  @csrf
                    <div class="row product-adding">
                        <div class="col-xl-12">
                            <div class="card">
                              
                                <div class="card-body">
                                    <div class="digital-add needs-validation">
                                   <div class="row">
                                    <div class="col-md-4">
                                    <label  class="col-form-label pt-0">Category</label>
                                    <input type="text" class="form-control" value="{{ucwords($listingProduct['categoryName'])}}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                    <label  class="col-form-label pt-0">Sub Category</label>
                                    <input type="text" class="form-control" value="{{ucwords($listingProduct['subcategory_name'])}}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                    <label  class="col-form-label pt-0">Product</label>
                                    <input type="text" class="form-control" value="{{ucwords($listingProduct['product_name'])}}" readonly>
                                    </div>

                                    <div class="col-md-4 mt-3">
                                    <label  class="col-form-label pt-0">Listing Type</label>
                                    <input type="text" class="form-control" value="{{ucwords($listingProduct['type'])}}" readonly>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                    <label  class="col-form-label pt-0">Sale Type</label>
                                    <input type="text" class="form-control" value="{{($listingProduct['sale_type']=='1') ? 'Single Pieces':'Whole Sells'}}" readonly>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                    <label  class="col-form-label pt-0">Quality</label>
                                    <input type="text" class="form-control" value="{{$listingProduct['quality']}}" readonly>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                    <label  class="col-form-label pt-0">Estimated Purchase Date</label>
                                    <input type="text" class="form-control" value="{{date('d M Y',strtotime($listingProduct['estimated_purchasedate']))}}" readonly>
                                    </div>

                                    @php
    $valueField = json_decode($listingProduct['additional_fields'] ?? '{}', true); 
@endphp
    @foreach($valueField as $fieldName => $fieldValue)
        @php
            $value = is_array($fieldValue) ? ($fieldValue[0] ?? '') : $fieldValue;
        @endphp

        <div class="col-md-4 mt-3">
            <label class="col-form-label pt-0">{{ ucwords(str_replace('_', ' ', $fieldName)) }}</label>
            <input class="form-control" type="text" value="{{ old($fieldName, $value) }}" readonly/>
        </div>
    @endforeach


                                    <div class="col-md-4 mt-3">
                                    <label  class="col-form-label pt-0">Quantity</label>
                                    <input type="text" class="form-control" value="{{$listingProduct['quantity']}}" readonly>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                    <label  class="col-form-label pt-0">Price</label>
                                    <input type="text" class="form-control" value="{{$listingProduct['price']}}" readonly>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                    <label  class="col-form-label pt-0">Currency</label>
                                    <input type="text" class="form-control" value="Rs" readonly>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                    <label  class="col-form-label pt-0">Item Condition</label>
                                    <input type="text" class="form-control" value="{{ucwords($listingProduct['item_condition'])}}" readonly>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                    <label  class="col-form-label pt-0">Status</label>
                                    <input type="text" class="form-control" value="{{ucwords($listingProduct['status'])}}" readonly>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                    <label  class="col-form-label pt-0">Description</label>
                                   <textarea name="" id="" readonly  cols="4" rows="4">{{$listingProduct['description']}}</textarea>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                    <label class="col-form-label pt-0">Main Image</label>
                                    <br>
                                    <img src="{{asset('uploads/product/'.$listingProduct['main_image'])}}" class="img-fluid" width="100px" height="100px">
                                    </div>

                                    @php
                        $otherImage = json_decode($listingProduct['other_image'] ?? '{}', true); 
                                            @endphp
                                          
                                            @foreach($otherImage as $key)
                                            <div class="col-md-2 mt-3">
                                            <img src="{{asset('uploads/product/'.$key) }}" alt="other Image" width="100px" height="100px"> 
                                            </div>
                                            @endforeach

                                            <div class="form-group mt-3">
                                            <label class="col-form-label"><span>*</span>
                                            Status</label>
                                               <select name="status" id="" class="form-control">
                                               <option value="published">Approval</option>
                                               <option value="rejected">Rejected</option>
                                               <option value="edit">Edit</option>
                                               </select>
                                          
                                        </div>
                                    <div class="form-group mb-0">
                                            <div class="description-sm">
                                            <label class="col-form-label"><span>*</span>
                                            Notes</label>
                                                <textarea id="notes" name="notes" cols="10" rows="4"></textarea>
                                            </div>
                                        </div>
                                    <input type="hidden" name="id" value="{{$listingProduct['id']}}">
                                    <div class="form-group text-center mt-3">
                                    <a href="{{route('listingproduct')}}" class="btn btn-danger me-3">Back</a>
                                    <button type="submit" class="btn btn-warning">Submit</button>
                                        </div>
                                   </div>    <!-- end row -->
                                             
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>

                    </form>
                </div>
                <!-- Container-fluid Ends-->
            </div>

@endsection

