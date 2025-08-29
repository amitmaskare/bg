@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Edit Listing Products
                                       
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
                                    <li class="breadcrumb-item">Digital</li>
                                    <li class="breadcrumb-item active">Edit Listing Product</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <form action="{{route('listingproduct.update', ['id' => $listingproduct->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row product-adding">
                        <div class="col-xl-6">
                            <div class="card">
                               
                                <div class="card-body">
                                    <div class="digital-add needs-validation">
                                   
                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-md-10"> 
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                Category</label>
                                           <select name="categoryId" id="categoryId" class="form-control" onchange="getSubcategoryValue(this.value)" required>
                                            <option value="">Select</option>
                                            @if($categories)
                                            @foreach($categories as $key)
                                            <option value="{{$key->categoryId}}" {{ $listingproduct->categoryId == $key->categoryId ? 'selected' : '' }}>{{$key->categoryName}}</option>
                                            @endforeach
                                            @endif
                                           </select>
                                           </div>
                                         <div class="col-md-2">
                                                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#myCat">+
                                            </button>
                                                </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                        <div class="col-md-10"> 
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Sub Category</label>
                                           <!-- <select name="subcategoryId" id="subcategoryId" class="form-control" onchange="getProductData(this.value)">
                                            <option value="">Select</option> -->

                                            <select name="subcategoryId" id="subcategoryId" class="form-control" required>
                                            <option value="">Select</option>
                                            @if($subcategories)
                                            @foreach($subcategories as $key)
                                            <option value="{{$key->subcategoryId}}" {{ $listingproduct->subcategoryId ==  $key->subcategoryId ? 'selected' : ''}}>{{$key->name}}</option>
                                            @endforeach
                                            @endif
                                           </select>
                                          
                                           </div>
                                           <div class="col-md-2">
                                           <a href="{{route('addsubcategory')}}" class="btn btn-sm btn-info mt-3">Add</a>
                                           </div>
                                           </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-10">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Brand <span id="brand_example"></span></label>
                                           <select name="brandId" id="brandId" class="select2" style="width: 100%;" required>
                                            <option value="">Select</option>
                                            @foreach($brands as $brand)
                                        <option value="{{ $brand->brandId }}" {{ $listingproduct->brandId == $brand->brandId ? 'selected' : '' }}>
                                            {{ $brand->brand_name }}
                                        </option>
                                    @endforeach
                                           </select>
                                                </div>
                                                <div class="col-md-2">
                                                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#myModal">+
                                            </button>
                                                </div>
                                            </div>   
                                          
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-10">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                Product</label>
                                           <select name="productId" id="productId" class="form-control" onchange="getProductValue(this.value);getField(this.value)" required>
                                            <option value="">Select</option>
                                            @if($products)
                                            @foreach($products as $product)
                                            <option value="{{$product->productId}}" {{ $listingproduct->productId == $product->productId ? 'selected' : ''}}>{{ $product->name }}</option>
                                            @endforeach
                                            @endif
                                           </select>
                                           </div>
                                           <div class="col-md-2">
                                           <a href="{{route('addproduct')}}" class="btn btn-sm btn-info mt-3">Add</a>
                                           </div>
                                           </div>
                                        </div>
                                       
                                        @php
    $valueField = json_decode($listingproduct->additional_fields ?? '{}', true); 
@endphp

<div id="productField">
    @foreach($valueField as $fieldName => $fieldValue)
        @php
            // Get the first value from the array (if it's an array)
            $value = is_array($fieldValue) ? ($fieldValue[0] ?? '') : $fieldValue;
        @endphp

        <div class="form-group">
            <label class="col-form-label pt-0">{{ ucwords(str_replace('_', ' ', $fieldName)) }}</label>
            <input 
                class="form-control" 
                type="text" 
                name="{{ $fieldName }}[]" 
                value="{{ old($fieldName, $value) }}" />
        </div>
    @endforeach
</div>
                                        <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Listing Type</label>
                                           <select name="type" id="type" class="form-control" onchange="getSaleType(this.value)" required>
                                           <option value="">Select</option>
                                           <option value="sale" {{ $listingproduct->type == 'sale' ? 'selected' : ''}}>Sale</option>
                                           <option value="purchase" {{ $listingproduct->type == 'purchase' ? 'selected' : ''}}>Purchase</option>
                                           
                                           </select>
                                        </div>
                                        <div class="form-group" id="hideSaleType" style="display:{{$listingproduct->type == 'sale' ? 'block' : 'none'}};">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Sale Type</label>
                                           <select name="sale_type" id="sale_type" class="form-control">
                                           <option value="">Select</option>
                                           <option value="1" {{ $listingproduct->sale_type == '1' ? 'selected' : ''}}>Single Pieces</option>
                                          
                                           <option value="2" {{ $listingproduct->sale_type == '2' ? 'selected' : ''}}>Whole Sell</option>
                                           
                                           </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-10">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Stock Location <span id="brand_example"></span></label>
                                           <select name="stock_location_id" id="stock_location_id" class="form-control" style="width: 100%;">
                                            <option value="">Select</option>
                                            @if($stocklocation)
                                            @foreach($stocklocation as $key)
                                            <option value="{{$key->id}}" {{ $listingproduct->stock_location_id == $key->id ? 'selected' : ''}} >{{$key->name}}</option>
                                            @endforeach
                                            @endif
                                           </select>
                                                </div>
                                                <div class="col-md-2">
                                                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#stockmyModal">+
                                            </button>
                                                </div>
                                            </div>   
                                          
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span> Product Name</label>
                                            <input class="form-control" id="product_name" type="text"
                                                required="" name="product_name" value="{{ $listingproduct->product_name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span> Quantity</label>
                                            <input class="form-control" id="quantity" type="text"
                                                required="" name="quantity" value="{{ $listingproduct->quantity }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span> MRP</label>
                                            <input class="form-control"  type="text" id="mrp"
                                                required="" name="mrp" value="{{ $listingproduct->mrp }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span> Price</label>
                                            <input class="form-control"  type="text" id="price"
                                                required="" name="price" value="{{ $listingproduct->price }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0">Discount</span></label>
                                            <input class="form-control"  type="text" id="discount"
                                                name="discount" value="{{ $listingproduct->discount }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0">Offer</span></label>
                                            <input class="form-control"  type="text" id="offer"
                                                name="offer" value="{{ $listingproduct->offer }}">
                                        </div>
                                       
                                        <div class="form-group">
                                            <div class="row">
                                            <div class="col-md-10">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                              Measure</label>
                                           <select name="weightId" id="weightId" class="form-control" required>
                                            <option value="">Select</option>
                                            @if($manufacture)
                                            @foreach($manufacture as $key)
                                            <option value="{{$key->weightId}}"  {{ $listingproduct->weightId == $key->weightId ? 'selected' : '' }}>{{$key->weight}}</option>
                                            @endforeach
                                            @endif
                                           </select>
                                        </div>
                                        <div class="col-md-2">
                                                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#myMea">+
                                            </button>
                                                </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span> Length</label>
                                            <input class="form-control"  type="text" name="length" id="length"
                                                required="" value="{{$listingproduct->length}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span>Breadth</label>
                                            <input class="form-control"  type="text" name="breadth" id="breadth"
                                                required="" value="{{$listingproduct->breadth}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span>Height</label>
                                            <input class="form-control"  type="text" name="height" id="height"
                                                required="" value="{{$listingproduct->height}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span>WeightId</label>
                                            <input class="form-control"  type="text" name="weightId" id="weightId"
                                                required="" value="{{$listingproduct->weightId}}">
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span>Expected Purchased</label>
                                            <input class="form-control"  type="date" name="estimated_purchasedate" id="estimated_purchasedate" 
                                                required="" value="{{$listingproduct->estimated_purchasedate}}">
                                        </div> -->

                            <div class="form-group">
                                <label class="col-form-label pt-0">Manufacture</label>
                                <input class="form-control" type="text" name="manufacture" id="manufacture" value="{{ $listingproduct->manufacture }}" >
                            </div>

                            <div class="form-group">
                                <label class="col-form-label pt-0">Supplier</label>
                                <input class="form-control" type="text" name="supplier" id="supplier" value="{{ $listingproduct->supplier }}" >
                            </div>

                            <div class="form-group">
                                <label class="col-form-label pt-0"> UPC</label>
                                <input class="form-control" type="text" name="upc" id="upc" value="{{ $listingproduct->upc }}" >
                            </div>

                            <div class="form-group">
                                <label class="col-form-label pt-0">EAN</label>
                                <input class="form-control" type="text" name="ean" id="ean" value="{{ $listingproduct->ean }}" >
                            </div>

                            <div class="form-group">
                                <label class="col-form-label pt-0"><span>*</span> GST</label>
                                <input class="form-control" type="text" name="gst" id="gst" value="{{ $listingproduct->gst }}" required>
                            </div>
                                             
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card">
                               
                                <div class="card-body">
                                    <div class="digital-add needs-validation">
                                    <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Item Condition</label>
                                           <select name="item_condition" id="item_condition" class="form-control" onchange="itemCondition(this.value)" required>
                                           <option value="">Select</option>
                                           <option value="new" {{ $listingproduct->item_condition == 'new' ? 'selected' : ''}}>New</option>
                                           <option value="used" {{ $listingproduct->item_condition == 'used' ? 'selected' : ''}}>Used</option>
                                          
                                           </select>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Quality</label>
                                           <input name="quality" id="quality" class="form-control" value="{{$listingproduct->quality}}" required>
                                         
                                        </div> -->
                                        <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                            Expiry Date</label>
                                           <input name="expirydate" type="date" id="expirydate" class="form-control" value="{{$listingproduct->expirydate}}" required>
                                         
                                        </div>
                                        <div id="hideUsedItem" style="display:{{ $listingproduct->item_condition == 'used' ? 'block' : 'none'}};">
                                        <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Quality</label>
                                           <select name="quality" id="quality" class="form-control" >
                                           <option value="">Select</option>
                                           <option value="good" {{ $listingproduct->quality == 'good' ? 'selected' : ''}}>Good</option>
                                           <option value="fair" {{ $listingproduct->quality == 'fair' ? 'selected' : ''}}>Fair</option>
                                          
                                           </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Estimated Purchase Date</label>
                                            <input type="date" class="form-control" name="estimated_purchasedate" id="estimated_purchasedate" value="{{ $listingproduct->estimated_purchasedate }}" >
                                        </div>
                                </div>
                                   
                                    <div class="form-group">
                                    <label class="col-form-label">Specification</label>
                                    <textarea rows="5" cols="12" name="specification" id="specification">{{ $listingproduct->specification }}</textarea>
                                    </div>
                                        <div class="form-group mb-0">
                                            <div class="description-sm">
                                            <label class="col-form-label"><span>*</span>
                                            Description</label>
                                                <textarea id="description" name="description" cols="10" rows="4" required>{{ $listingproduct->description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label"><span>*</span>
                                               Image</label>
                                            <input class="form-control" name="main_image" type="file"  onchange="previewImage(event)" >
                                            <br>
                                            <img id="main_image_preview" src="#" alt="Image Preview" style="display:none; max-height: 200px; margin-top:10px;" />
                                        <img src="{{ asset('uploads/product/' . $listingproduct->main_image) }}" alt="Product Image" width="50px">
                                        <input type="hidden" name="old_mainimage" value="{{$listingproduct->main_image}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">
                                               Other Image</label>
                                            <input class="form-control" name="other_image[]" type="file" multiple >
                                            <br>
                                            <!-- @php
                                                $otherImage = json_decode($listingproduct->other_image ?? '{}', true); 
                                            @endphp
                                            @foreach($otherImage as $key)
                                         
                                             <img src="{{ asset('uploads/product/'.$key) }}" alt="other Image" width="50px"> 
                                            @endforeach
                                         <input type="hidden" name="old_otherimage" value="{{$listingproduct->other_image}}">  -->
                                         <div class="row">
                                         @foreach($otherImage as $img)
                                                <div class="col-md-3" style="margin-bottom:10px;">
                                                    <img src="{{ asset('uploads/product/'.$img) }}" style="width:80px;height:50px"><br><br>
                                                    <input type="checkbox" name="remove_otherimage[]" value="{{ $img }}"> Remove
                                                </div>
                                                @endforeach
                                                <input type="hidden" name="old_otherimage" value='{{ $listingproduct->other_image }}'>
                                        </div>
                                        </div>

                                         <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Shipping Included</label>
                                           <select name="shipping_included" id="shipping_included" class="form-control" required onchange="shippingInclude(this.value)">
                                           <option value="yes" {{ $listingproduct->shipping_included=='yes' ? 'selected':'' }}>Yes</option>
                                           <option value="no" {{ $listingproduct->shipping_included=='no' ? 'selected':'' }}>No</option>
                                          
                                           </select>
                                        </div>
                                         <div class="form-group" id="hideKilometer" style="display:{{ $listingproduct->shipping_included=='no' ? 'none':'block' }}">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Kilometer</label>
                                           <input type="text" class="form-control" name="kilometer" id="kilometer" value="{{ $listingproduct->kilometer }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Status</label>
                                           <select name="status" id="status" class="form-control" required>
                                           <option value="">Select</option>
                                           <option value="draft" {{ $listingproduct->status == 'draft' ? 'selected' : ''}}>Save as Draft</option>
                                           <option value="pending" {{ $listingproduct->status == 'pending' ? 'selected' : ''}}>Submit for Approval</option>
                                          
                                           </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Feature Product</label>
                                           <select id="feature_product" name="feature_product" class="form-control" required>
                                           <option value="">Select</option>
                                           <option value="1" {{ $listingproduct->feature_product == '1' ? 'selected' : ''}}>Yes</option>
                                           <option value="0" {{ $listingproduct->feature_product == '0' ? 'selected' : ''}}>No</option>
                                           
                                           </select>
                                        </div>
                                       <input type="hidden" name="slug_url" id="slug_url">
                                        <div class="form-group">
                                           <button type="submit" class="btn btn-warning">Submit</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>

                    </form>
                </div>
                <!-- Container-fluid Ends-->
            </div>

            <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Brand</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
        
          <div class="card-body">

           <form id="brandForm" action="{{route('saveBrandAjax')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label>Brand Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="brand_name" autocomplete="off" required>
              </div>
             
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

            <div id="myCat" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Category</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
        
          <div class="card-body">

           <form id="categoryForm" action="{{route('saveCategoryAjax')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label>Category Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="category_name" autocomplete="off" required>
              </div>
             
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

  <div id="myMea" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Measure</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
        
          <div class="card-body">

           <form id="measureForm" action="{{route('saveMeasureAjax')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label>Measure Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="measure_name" autocomplete="off" required>
              </div>
             
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
  
  <div id="stockmyModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Stock location</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
        
          <div class="card-body">

           <form id="stockForm" action="{{route('saveStockAjax')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label> Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="name" autocomplete="off" required>
              </div>
             
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
@endsection



<script>

    function getProductValue(productId)
    {
        $.ajax({
                    url: "{{ url('getProductValue') }}",
                    type: 'POST',
                    cache:false,
                    data: {
                         productId:productId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result)
                    {
                        if(result.data==1)
                    {
                       
                        $("#product_name").val(result.product_name);
                        $("#price").val(result.price);
                         $("#description").val(result.description);
                         $("#slug_url").val(result.slug_url);
                         $("#specification").val(result.specification);
                         $("#weightId").val(result.weightId);
                         $("#length").val(result.length);
                         $("#breadth").val(result.breadth);
                         $("#height").val(result.height);
                         $("#manufacture").val(result.manufacture);
                         $("#supplier").val(result.supplier);
                         $("#upc").val(result.upc);
                         $("#ean").val(result.ean);
                         $("#gst").val(result.gst);
                    }
                    else{
                       
                         $("#price").val('');
                      
                         $("#description").val('');
                         $("#slug_url").val(''); 
                    }
                    }
                });
    }

    function getSubcategoryValue(categoryId)
    {
        $.ajax({
                    url: "{{ url('getSubcategoryValue') }}",
                    type: 'POST',
                    cache:false,
                    data: {
                         categoryId:categoryId,
                        _token: '{{ csrf_token() }}'
                    },
                   // dataType:'json',
                    success:function(result)
                    {
                     $('#subcategoryId').html(result);
                    }
                });

    }
    function getProductData(subcategoryId)
    {
        const categoryId=$('#categoryId').val();
        $.ajax({
                    url: "{{ url('getProductData') }}",
                    type: 'POST',
                    cache:false,
                    data: {
                         subcategoryId:subcategoryId,
                         categoryId:categoryId,
                        _token: '{{ csrf_token() }}'
                    },
                   // dataType:'json',
                    success:function(result)
                    {
                     $('#productId').html(result);
                    }
                });

    }

    function getField(productId)
    {  
        $.ajax({
                    url: "{{ url('getadditionalfieldInListing') }}",
                    type: 'POST',
                    cache:false,
                    data: {
                        productId:productId,
                        _token: '{{ csrf_token() }}'
                    },
                   // dataType:'json',
                    success:function(result)
                    {
                        $('#productField').html(result);
                    }
                });
    }

    function getSaleType(val)
    {
        
     if (val == 'sale') {
        document.getElementById('hideSaleType').style.display = '';
    } else {
        document.getElementById('hideSaleType').style.display = 'none';
    }
    }

    function itemCondition(val)
    {
        if (val == 'used') {
        document.getElementById('hideUsedItem').style.display = '';
    } else {
        document.getElementById('hideUsedItem').style.display = 'none';
    }  
    }

    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('main_image_preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $('#brandForm').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            type: 'POST',
            url: '{{ route("saveBrandAjax") }}',
            data: formData,
            success: function (response) {
                if (response.success) { 
                    $('#brandId').append(
                        $('<option>', {
                            value: response.brand.brandId,
                            text: response.brand.brand_name,
                            selected: true
                        })
                    );
                    $('#myModal').modal('hide');
                    form[0].reset();
                } else { console.log("no");
                    alert('Something went wrong while saving.');
                }
            },
            error: function () {
                alert('Failed to save brand.');
            }
        });
    });
});

$(document).ready(function () {
    $('#stockForm').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            type: 'POST',
            url: '{{ route("saveStockAjax") }}',
            data: formData,
            success: function (response) {
             
                if (response.success) { 
                    $('#stock_location_id').append(
                        $('<option>', {
                            value: response.name.id,
                            text: response.name.name,
                            selected: true
                        })
                    );
                    $('#stockmyModal').modal('hide');
                    form[0].reset();
                } else { console.log("no");
                    alert('Something went wrong while saving.');
                }
            },
            error: function () {
                alert('Failed to save brand.');
            }
        });
    });
});

</script>

<script>
$(document).ready(function () {
    $('#categoryForm').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            type: 'POST',
            url: '{{ route("saveCategoryAjax") }}',
            data: formData,
            success: function (response) {
                if (response.success) {  
                    
                    $('#categoryId').append(
                        $('<option>', {
                            value: response.category.categoryId,
                            text: response.category.categoryName,
                            selected: true
                        })
                    );
                    $('#myCat').modal('hide');
                    form[0].reset();
                } else { console.log("no");
                    alert('Something went wrong while saving.');
                }
            },
            error: function () {
                alert('Failed to save category.');
            }
        });
    });
});
</script>

<script>
$(document).ready(function () {
    $('#measureForm').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            type: 'POST',
            url: '{{ route("saveMeasureAjax") }}',
            data: formData,
            success: function (response) {
                console.log(response); 
                if (response.success) {  
                    
                    $('#weightId').append(
                        $('<option>', {
                            value: response.measure.weightId,
                            text: response.measure.weight,
                            selected: true
                        })
                    );
                    $('#myMea').modal('hide');
                    form[0].reset();
                } else { console.log("no");
                    alert('Something went wrong while saving.');
                }
            },
            error: function () {
                alert('Failed to save measure.');
            }
        });
    });
});

function shippingInclude(val)
{
    if(val=='no')
{
    document.getElementById('hideKilometer').style.display='none';
}
else{
   document.getElementById('hideKilometer').style.display='block'; 
}
}
</script>