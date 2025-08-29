@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Listings
                                       
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
                                    <li class="breadcrumb-item">Listing</li>
                                    <li class="breadcrumb-item active">List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                            @admincan('listing-create')
                            <a href="{{route('addlistingproduct')}}" class="btn btn-primary mt-3 mr-3" style="width:10%;">Add
                            </a>
                             @endadmincan
                            <h3 class="fw-bold m-5">Sell Listings</h3>
                                <div class="card-body order-datatable">
                                    <table class="display basic-1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Type</th>
                                                <th>Image</th>
                                                
                                                <th>Product</th>
                                               
                                                <th>Qty Status</th>
                                                <th>Price(Rs.)</th>
                                                <th>Create</th>
                                                <th>Status</th>
                                                <th>Bids</th>
                                                <th>Orders</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(!$data['product']->isEmpty())
                                            @php $sr = 1; @endphp
                                            @foreach($data['product'] as $key => $item)
                                            @php $totalBid=DB::table('bids')->where('listingId',$item->id)->get(); @endphp
                                                @if($item->type === 'sale')
                                            <tr>
                                                <td>
                                                    {{ $item->id }}
                                                    <div class="icon-circle">
                                                        <a href="javascript:void(0)" onclick="accordian({{$item->id}})" id="toggleBtn{{ $item->id }}">
                                                            <i class="fa fa-angle-down text-info ffs-2"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-secondary">{{ ucfirst($item->type) }}</span>
                                                </td>
                                                <td>
                                                    @php
                                                        $imagePath = 'uploads/product/' . $item->main_image;
                                                        $imageExists = $item->main_image && file_exists(public_path($imagePath));
                                                        $imageUrl = $imageExists ? asset($imagePath) : asset('assets/images/electronics/product/25.jpg');
                                                    @endphp
                                                    <a href="{{ $imageUrl }}" data-lightbox="product-image">
                                                        <img src="{{ $imageUrl }}" alt="" width="50px" height="50px" class="img-fluid lazyloaded">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ url('listingproduct/view/' . $item->id) }}">{{ ucfirst($item->name) }}</a>
                                                    <div class="mt-2" id="fieldList{{$item->id}}" style="display:none;">
                                                                                    @php
                                                                $decodedFields = [];
                                                                if (!empty($item->additional_fields)) {
                                                                    $parsed = json_decode($item->additional_fields, true);
                                                                    if (json_last_error() === JSON_ERROR_NONE && is_array($parsed)) {
                                                                        $decodedFields = $parsed;
                                                                    }
                                                                }
                                                            @endphp

                                                            @if(!empty($decodedFields))
                                                                @foreach($decodedFields as $fieldName => $fieldValue)
                                                                    @php
                                                                        $fieldVal = is_array($fieldValue) ? ($fieldValue[0] ?? '') : $fieldValue;
                                                                    @endphp
                                                                    <div class="mt-1">
                                                                        {{ ucwords(str_replace('_', ' ', $fieldName)) }}: {{ $fieldVal }}
                                                                    </div>
                                                                @endforeach
                                                            @endif

                                                    </div>
                                                </td>
                                                <td>
                                                    List : <span class="badge badge-success">10</span><br>
                                                    Avl : <span class="badge badge-warning mt-1">10</span>
                                                </td>
                                                <td>{{ $item->price ?? '' }}</td>
                                                <td>{{ $item->created_at ? date('d-M-Y', strtotime($item->created_at)) : '' }}</td>
                                                <td>
                                                    @if($item->status=='pending')
                                                Under Review
                                                    @else
                                                    {{ ucfirst($item->status) }}
                                                    @endif
                                                </td>
                                                <td><a href="{{ route('bidlist', ['id' => $item->id]) }}">{{ count($totalBid) }}</a></td>
                                                <td><a href="javascript:void(0)">0</a></td>
                                                <td>
                                                    @admincan('employee-view')
                                                <a href="#" onclick="viewProductInformation({{$item->id}})" title="view"><i class="fa fa-eye me-2 font-success"></i></a>
                                                 @endadmincan
                                                                            @if($item->status=='sold' || $item->status=='closed')
                                                                            
                                                                            <div style="display:none;">

                                                                            <a href="{{ route('listingproduct.edit',['id'=>$item->id]) }}" title="Edit"><i class="fa fa-edit me-2 font-success"></i></a>
                                                                            <a href="javascript:void(0)" onclick="deleteListingProduct({{ $item->id }})" title="Delete"><i class="fa fa-trash font-danger"></i></a>
                                                                            <a href="javascript:void(0)" title="Change to draft" onclick="changeStatus({{ $item->id}})"><i class="fa fa-undo font-warning"></i></a>
                                                                            </div>
                                                                            @elseif($item->status=='draft')
                                                                            <div>
                                                                                 @admincan('employee-edit')
                                                                            <a href="{{ route('listingproduct.edit',['id'=>$item->id]) }}" title="Edit"><i class="fa fa-edit me-2 font-success"></i></a>
                                                                             @endadmincan
                                                                              @admincan('employee-delete')
                                                                            <a href="javascript:void(0)" onclick="deleteListingProduct({{ $item->id }})" title="Delete"><i class="fa fa-trash font-danger"></i></a>
                                                                             @endadmincan
                                                                              @admincan('employee-status')
                                                                            <a href="javascript:void(0)" title="{{ isset($item->status) && $item->status === 'pending' ? 'Change to Draft' : 'Submit for Review' }}" onclick="changeStatus({{ $item->id }}, '{{ isset($item->status) && $item->status === 'draft' || $item->status === 'rejected' ? 'pending' : 'draft' }}')"><i class="fa fa-check-circle font-warning"></i></a>
                                                                             @endadmincan    
                                                                        </div>
                                                                            @elseif($item->status=='published' || $item->status=='pending' || $item->status=='rejected' )
                                                                            <div style="display:none;">
                                                                            <a href="{{ route('listingproduct.edit',['id'=>$item->id]) }}" title="Edit"><i class="fa fa-edit me-2 font-success"></i></a>
                                                                            <a href="javascript:void(0)" onclick="deleteListingProduct({{ $item->id }})" title="Delete"><i class="fa fa-trash font-danger"></i></a>
                                                                            </div>
                                                                            <a href="javascript:void(0)" title="Change to draft" onclick="changeStatus({{ $item->id}},'draft')"><i class="fa fa-undo font-warning"></i></a>
                                                                        
                                                                            @endif
                                                                        </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="11"><center>No Data Found</center></td>
                                    </tr>
                                @endif

                                          
                                        </tbody>
                                    </table>
                                </div>

                                <h3 class="fw-bold m-5">Purchase Listings</h3>
                                <div class="card-body order-datatable mt-5">
                                    <table class="display basic-1 table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Type</th>
                                                <th>Image</th>
                                                
                                                <th>Product</th>
                                               
                                                <th>Qty Status</th>
                                                <th>Price(Rs.)</th>
                                                <th>Create</th>
                                                <th>Status</th>
                                                <th>Bids</th>
                                                <th>Orders</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($data['product']->isNotEmpty())
    @php $sr = 1; @endphp
    @foreach($data['product'] as $key)
    @php $totalBid=DB::table('bids')->where('listingId',$key->id)->get(); @endphp
        @if($key->type === 'purchase')
            <tr>
                <td>
                    {{ $key->id }}
                    <div class="icon-circle">
                        <a href="javascript:void(0)" onclick="accordian({{$key->id}})" id="toggleBtn{{ $key->id }}">
                            <i class="fa fa-angle-down text-info ffs-2"></i>
                        </a>
                    </div>
                </td>
                <td>
                    <span class="badge badge-secondary">{{ ucfirst($key->type) }}</span>
                </td>
                <td>
                    @php
                        $imagePath = 'uploads/product/' . $key->main_image;
                        $imageExists = $key->main_image && file_exists(public_path($imagePath));
                        $imageUrl = $imageExists ? asset($imagePath) : asset('assets/images/electronics/product/25.jpg');
                    @endphp
                    <a href="{{ $imageUrl }}" data-lightbox="product-image">
                        <img src="{{ $imageUrl }}" alt="" width="50px" height="50px" class="img-fluid lazyloaded">
                    </a>
                </td>
                <td>
                    <a href="{{ url('listingproduct/view/' . $key->id) }}">{{ ucfirst($key->name) }}</a>
                    <div class="mt-2" id="fieldList{{$key->id}}" style="display:none;">
                                                    @php
                                $decodedFields = [];
                                if (!empty($key->additional_fields)) {
                                    $parsed = json_decode($key->additional_fields, true);
                                    if (json_last_error() === JSON_ERROR_NONE && is_array($parsed)) {
                                        $decodedFields = $parsed;
                                    }
                                }
                            @endphp

                            @if(!empty($decodedFields))
                                @foreach($decodedFields as $fieldName => $fieldValue)
                                    @php
                                        $fieldVal = is_array($fieldValue) ? ($fieldValue[0] ?? '') : $fieldValue;
                                    @endphp
                                    <div class="mt-1">
                                        {{ ucwords(str_replace('_', ' ', $fieldName)) }}: {{ $fieldVal }}
                                    </div>
                                @endforeach
                            @endif

                    </div>
                </td>
                <td>
                    List : <span class="badge badge-success">10</span><br>
                    Avl : <span class="badge badge-warning mt-1">10</span>
                </td>
                <td>{{ $key->price ?? '' }}</td>
                <td>{{ $key->created_at ? date('d-M-Y', strtotime($key->created_at)) : '' }}</td>
                <td>
                    @if($key->status=='pending')
                   Under Review
                    @else
                    {{ ucfirst($key->status) }}
                    @endif
                </td>
                <td><a href="{{ route('bidlist', ['id' => $key->id]) }}">{{ count($totalBid) }}</a></td>

                <td><a href="javascript:void(0)">0</a></td>
                <td>
                <a href="#" onclick="viewProductInformation({{$key->id}})" title="view"><i class="fa fa-eye me-2 font-success"></i></a>
                                            @if($key->status=='sold' || $key->status=='closed')
                                            
                                            <div style="display:none;">
                                            <a href="{{route('listingproduct.edit',['id'=>$key->id])}}" title="Edit"><i class="fa fa-edit me-2 font-success"></i></a>
                                            <a href="javascript:void(0)" onclick="deleteListingProduct({{ $key->id }})" title="Delete"><i class="fa fa-trash font-danger"></i></a>
                                            <a href="javascript:void(0)" title="Change to draft" onclick="changeStatus({{ $key->id}})"><i class="fa fa-undo font-warning"></i></a>
                                            </div>
                                            @elseif($key->status=='pending' || $key->status=='rejected' || $key->status=='draft')
                                            <div>
                                            <a href="{{route('listingproduct.edit',['id'=>$key->id])}}" title="Edit"><i class="fa fa-edit me-2 font-success"></i></a>
                                            <a href="javascript:void(0)" onclick="deleteListingProduct({{ $key->id }})" title="Delete"><i class="fa fa-trash font-danger"></i></a>
                                            <a href="javascript:void(0)" title="{{ isset($key->status) && $key->status === 'pending' ? 'Change to Draft' : 'Submit for Review' }}" onclick="changeStatus({{ $key->id }}, '{{ isset($key->status) && $key->status === 'draft' || $key->status === 'rejected' ? 'pending' : 'draft' }}')"><i class="fa fa-check-circle font-warning"></i></a>
                                            </div>
                                            @elseif($key->status=='published')
                                            <div style="display:none;">
                                            <a href="{{route('listingproduct.edit',['id'=>$key->id])}}" title="Edit"><i class="fa fa-edit me-2 font-success"></i></a>
                                            <a href="javascript:void(0)" onclick="deleteListingProduct({{ $key->id }})" title="Delete"><i class="fa fa-trash font-danger"></i></a>
                                            </div>
                                            <a href="javascript:void(0)" title="Change to draft" onclick="changeStatus({{ $key->id}},'draft')"><i class="fa fa-undo font-warning"></i></a>
                                           
                                            @endif
                                        </td>
            </tr>
        @endif
    @endforeach
@else
    <tr>
        <td colspan="11"><center>No Data Found</center></td>
    </tr>
@endif
                                          
                                        </tbody>
                                    </table>
                                </div>

                              
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div> 


            <div class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="editBannerModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Product Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                    <label>Category :&nbsp;<span id="categoryinfo" ></span></label>
                            </div>
                            <div class="col-md-4">
                                <label>Sub Category :&nbsp;<span id="subcategory_name" ></span></label>
                            </div>
                            <div class="col-md-4">
                                <label>Product Name :&nbsp;<span id="product_name" ></span></label>
                            </div>
                            <div class="col-md-4"  style="margin-top:20px;">
                                <label>Type :&nbsp;<span id="type" style="background-color:#13c9ca;padding:5px;color:#fff"></span></label>
                            </div>
                            <div class="col-md-4" style="margin-top:20px;">
                                <label>Sale type :&nbsp;<span id="sale_type" ></span></label>
                            </div>
                            <div class="col-md-4" style="margin-top:20px;">
                                <label>Quality :&nbsp;<span id="quality" ></span></label>
                            </div>
                            <!-- <div class="col-md-4" style="margin-top:20px;">
                                <label>Date :&nbsp;<span id="date" ></span></label>
                            </div> -->
                            <div class="col-md-4" style="margin-top:20px;">
                                <label>Quantity :&nbsp;<span id="quantity" ></span></label>
                            </div>
                            <div class="col-md-4" style="margin-top:20px;">
                                <label>Length :&nbsp;<span id="length" ></span></label>
                            </div>
                            <div class="col-md-4" style="margin-top:20px;">
                                <label>Breadth :&nbsp;<span id="breadth" ></span></label>
                            </div>
                            <div class="col-md-4" style="margin-top:20px;">
                                <label>Height :&nbsp;<span id="height" ></span></label>
                            </div>
                            <div class="col-md-4" style="margin-top:20px;">
                                <label>Manufacture :&nbsp;<span id="manufacture" ></span></label>
                            </div>
                            <div class="col-md-4" style="margin-top:20px;">
                                <label>Supplier :&nbsp;<span id="supplier" ></span></label>
                            </div>
                            <div class="col-md-4" style="margin-top:20px;">
                                <label>Upc :&nbsp;<span id="upc" ></span></label>
                            </div>
                            <div class="col-md-4" style="margin-top:20px;">
                                <label>EAN :&nbsp;<span id="ean" ></span></label>
                            </div>
                            <div class="col-md-4" style="margin-top:20px;">
                                <label>Gst :&nbsp;<span id="gst" ></span></label>
                            </div>
                            <div class="col-md-4" style="margin-top:20px;">
                                <label>Price :&nbsp;<span id="price" ></span></label>
                            </div>
                            <div class="col-md-4" style="margin-top:20px;">
                                <label>Item condition :&nbsp;<span id="item_condition" ></span></label>
                            </div>
                            <div class="col-md-4" style="margin-top:20px;">
                                <label>Status :&nbsp;<span id="status" style="background-color:green;padding:5px;color:#fff"></span></label>
                            </div>
                            <div class="col-md-4" style="margin-top:20px;">
                                <label>Description :&nbsp;<span id="description" ></span></label>
                            </div>
                            <div class="col-md-4" style="margin-top:20px;">
                                <label>Weight ID :&nbsp;<span id="weightId"></span></label>
                            </div>
                            <div class="col-md-4" style="margin-top:20px;" id="manigacture">
                            <label>Manufacture :&nbsp;<span id="manufacture"></span></label>
                        </div>

                        <div class="col-md-4" style="margin-top:20px;">
                            <label>Supplier :&nbsp;<span id="supplier"></span></label>
                        </div>

                        <div class="col-md-4" style="margin-top:20px;">
                            <label>UPC :&nbsp;<span id="upc"></span></label>
                        </div>

                        <div class="col-md-4" style="margin-top:20px;">
                            <label>EAN :&nbsp;<span id="ean"></span></label>
                        </div>

                        <div class="col-md-4" style="margin-top:20px;">
                            <label>GST :&nbsp;<span id="gst"></span></label>
                        </div>

                        <div class="col-md-4" style="margin-top:20px;">
                            <label>Stock Location ID :&nbsp;<span id="stock_location_id"></span></label>
                        </div>

                        <div class="col-md-4" style="margin-top:20px;">
                            <label>Estimated Purchase Date :&nbsp;<span id="estimated_purchasedate"></span></label>
                        </div>

                        <div class="col-md-4" style="margin-top:20px;">
                            <label>Currency ID :&nbsp;<span id="currencyId"></span></label>
                        </div>

                        <div class="col-md-4" style="margin-top:20px;">
                            <label>Expiry Date :&nbsp;<span id="expirydate"></span></label>
                        </div>

                        <div class="col-md-4" style="margin-top:20px;">
                            <label>Specification :&nbsp;<span id="specification"></span></label>
                        </div>
                        
                        <div class="col-md-4" style="margin-top:20px;">
                            <label>Main Image :&nbsp;<img  id="main_image" style="width:100px"></label>
                        </div>

                        <div class="col-md-4" style="margin-top:20px;">
                            <label>Other Image :&nbsp;<img src="" id="other_image" style="width:100px"></label>
                        </div>
                            <div class="col-md-12" style="margin-top:20px;" id="tableData">
                            <h5>Additional Information :</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="extraFieldsTable" style="font-size:13px">
                                    <thead style="background-color:#13c9ca;color:#fff" >
                                    <tr>
                                        <th colspan="2" style="color:#fff">Specification Information</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- JS will populate this -->
                                    </tbody>
                                </table>
                                </div>
                            </div>
                          
                        </div>
                        <div class="modal-footer">
                         
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close"> close</button>
                        </div>
                    </div>
                    
                </div>
            </div>

@endsection

<!-- Add in your <head> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">

<!-- Add before </body> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

<script src="{{ asset('js/custom.js') }}"></script>


<script>
      function deleteListingProduct(id) {
           var ask=confirm("Are you sure want to delete ?");
           if(ask==true)
           {
            window.location.href = "{{ url('admin/listingproduct/delete') }}" + '/' + id;

           }
                       
        }

        function changeStatus(id,status) {
            var capitalizedStatus = status.charAt(0).toUpperCase() + status.slice(1);
           var ask=confirm(`Change to ${capitalizedStatus} ?`);
           if(ask==true)
           {
            $.ajax({
                    url: "{{ url('changeStatus') }}",
                    type: 'POST',
                    cache:false,
                    data: {
                         id:id,
                         status:status,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result)
                    {
                       
                        location.reload();
                    }
                });
            
           }
                       
        }

        function accordian(id)
        {
          
    $("[id^='fieldList']").not(`#fieldList${id}`).slideUp();
    $("[id^='toggleBtn'] i").removeClass("fa-angle-up").addClass("fa-angle-down");
    const target = $(`#fieldList${id}`);
    const icon = $(`#toggleBtn${id} i`);

    if (target.is(":visible")) {
        target.slideUp();
        icon.removeClass("fa-angle-up").addClass("fa-angle-down");
    } else {
        target.slideDown();
        icon.removeClass("fa-angle-down").addClass("fa-angle-up");
    }
}

function viewProductInformation(produId)
      {
      
        $.ajax({
                    url: "{{ route('getproductInfoforView') }}",
                    type: 'POST',
                    cache:false,
                    data: {
                        produId:produId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result)
                    {
                    
                      $('#editBannerModal').modal('show');        
                
                      $('#categoryinfo').html(result.categoryName);
                      $('#subcategory_name').html(result.subcategory_name);
                      $('#product_name').html(result.product_name);
                      $('#type').html(result.type);
                      $('#sale_type').html(result.sale_type);
                      $('#quality').html(result.quality);
                      
                      $('#quantity').html(result.quantity);
                      $('#price').html(result.price);
                      $('#item_condition').html(result.item_condition);
                      $('#description').html(result.description);
                      $('#status').html(result.status);
                      $('#length').html(result.length);
                    $('#breadth').html(result.breadth);
                    $('#height').html(result.height);
                    $('#weightId').html(result.weightId);
                    $('#manufacture').html(result.manufacture);
                    $('#supplier').html(result.supplier);
                    $('#upc').html(result.upc);
                    $('#ean').html(result.ean);
                    $('#gst').html(result.gst);
                    $('#stock_location_id').html(result.stock_location_id);
                    $('#estimated_purchasedate').html(result.estimated_purchasedate);
                    $('#currencyId').html(result.currencyId);
                    $('#expirydate').html(result.expirydate);
                    $('#specification').html(result.specification);
                    $('#main_image').html(result.main_image);
                    $('#main_image').attr('src','uploads/product/'+result.main_image);
                    $('#other_image').attr('src','uploads/product/'+result.other_image);
                   
                    
                        if(result.extra_fields==''){
                            $('#tableData').css('display','none');

                        }
                      const tbody = document.querySelector("#extraFieldsTable tbody");
                        tbody.innerHTML = ''; 

                        const extraFields = result.extra_fields || {};

                        Object.entries(extraFields).forEach(([key, value]) => {
                            const row = `<tr>
                                <td>${key}</td>
                                <td>${value}</td>
                            </tr>`;
                            tbody.insertAdjacentHTML('beforeend', row);
                        });


                    }
                });
      }
</script>
