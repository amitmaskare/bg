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
                       @if(Session::get('success'))
                       <div class="alert alert-success">
                        {{Session::get('success')}}
                       </div>
                       @endif
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>List of Bids</h5>
                                </div>
                                <div class="card-body order-datatable">
                               
                                    <table class="display basic-1">
                                        <thead>
                                            <tr>
                                            <th>Listing Id</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <!-- <th>Brand</th> -->
                                            <th>Product Name</th>
                                            <!-- <th>Detail</th> -->
                                            <th>Product Price</th>
                                                <!-- <th>Bid Id</th> -->
                                                <th>Bid Amount</th>
                                                <th>Quantity Requested</th> 
                                                <th>Bid Response time</th> 
                                                <th>Counter Response Time</th> 
                                                <th>Status</th>
                                                <th>Bid Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($data['bidlist'])
                                            @foreach($data['bidlist'] as $item)
                                            <?php
                                                    $bidDetails = DB::table('bids')
                                                    ->leftJoin('listing_products', 'bids.listingId', '=', 'listing_products.id')
                                                    ->leftJoin('products', 'listing_products.productId', '=', 'products.productId')
                                                    ->leftJoin('categories', 'products.categoryId', '=', 'categories.categoryId')
                                                    ->leftJoin('subcategories', 'products.subcategoryId', '=', 'subcategories.subcategoryId')
                                                    ->leftJoin('brands', 'products.brandId', '=', 'brands.brandId')
                                                    ->where('bids.bidId', '=', $item->bidId) // Filter by the current bid's id
                                                    ->select(
                                                        'bids.bidId AS bidId',
                                                        'bids.amount',
                                                        'bids.quantity',
                                                        'bids.counter_offer_amount',
                                                        'bids.status',
                                                        'bids.created_at',
                                                        'products.productId AS productId',
                                                        'products.name AS name',
                                                        'products.description',
                                                        'products.price',
                                                        'categories.categoryName AS categoryName',
                                                        'subcategories.name AS subname',
                                                        'brands.brand_name AS brand_name'
                                                    )
                                                    ->first(); // Get the first (and only) result, as each bid should have only one entry
                                               
                                                      ?>

                                            <tr>
                                            <td>{{$bidDetails->productId }}</td>
                                            <td>{{ $bidDetails->categoryName ?? 'N/A' }}</td>
                                            <td>{{ $bidDetails->subname ?? 'N/A' }}</td>
                                            <!-- <td>{{ $bidDetails->brand_name ?? 'N/A' }}</td> -->
                                            <td>{{ $bidDetails->name ?? 'N/A' }}</td>
                                            <!-- <td>{{ $bidDetails->description ?? 'N/A' }}</td> -->
                                            <td>{{ $bidDetails->price ?? 'N/A' }}</td>
                                            <!-- <td>{{$item->bidId }}</td> -->
                                            <td>{{$item->amount}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{ $item->bid_response_time }}</td>
                                            <td>{{ $item->counter_response_time }}</td>
                                            <td>{{ucfirst($item->status)}}</td>
                                            <td>{{date('d-M-Y H:i A',strtotime($item->created_at))}}</td>
                                            <td>
                                              @if($item->status=='pending')
                                              <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editModal"  onclick="changeStatus({{$item->bidId}})">Bid Status</button>
                                              @endif
                                            </td>
                                            </tr>
                                          @endforeach
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


            <!--  edit mmodal -->
   <div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Change Status</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
       
          <div class="card-body">

          <form action="{{route('updateStatus')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Status<span style="color:red;">*</span></label>
                <select name="status" id="status" class="form-control" onchange="checkStatus(this.value)">
                <option value="">Select</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
                <option value="countered">Countered</option>
                </select>
              </div>
              <div class="form-group" id="bidprice" style="display:none;">
                <label>Counter Offer Amount<span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="counter_offer_amount" id="counter_offer_amount" autocomplete="off">
              </div>
              <input type="hidden" id="bidId" name="bidId">
              <div class="mt-4">
                <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                <a href="#" class="btn  btn-link" data-bs-dismiss="modal">Cancel</a>
              </div>
            </form>

          </div>
     
        </div>
      
      </div>
    </div>
  </div>
  <!--  end edit modal -->

@endsection

<script>
  function changeStatus(bidId)
  {
    
    document.getElementById('bidId').value = bidId;
  }
  function checkStatus(val) {
  if (val == 'countered') {
    $('#bidprice').show();
  } else {
    $('#bidprice').hide();
  }
}
</script>



