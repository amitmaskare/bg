@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Add Listing
                                       
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
                                    <li class="breadcrumb-item active">Add Listing</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <form action="{{route('savelistingproduct')}}" method="post" enctype="multipart/form-data">
                    @csrf
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
                                           <select name="categoryId" id="categoryId" class="select2" style="width: 100%;" onchange="getSubcategoryValue(this.value)">
                                            <option value="">Select</option>
                                            @if($data['category'])
                                            @foreach($data['category'] as $key)
                                            <option value="{{$key->categoryId}}">{{$key->categoryName}}</option>
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
                                           <!-- <select name="subcategoryId" id="subcategoryId" class="select2" style="width: 100%;" onchange="getProductData(this.value)">
                                            <option value="">Select</option> -->

                                            <select name="subcategoryId" id="subcategoryId" class="select2" style="width: 100%;" onchange="getProductData(this.value);">
                                            <option value="">Select</option>
                                            @if($data['subcategory'])
                                            @foreach($data['subcategory'] as $key)
                                            <option value="{{$key->subcategoryId}}">{{$key->name}}</option>
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
                                           <select name="brandId" id="brandId" class="select2" style="width: 100%;">
                                            <option value="">Select</option>
                                            @if($data['brand'])
                                            @foreach($data['brand'] as $key)
                                            <option value="{{$key->brandId}}">{{$key->brand_name}}</option>
                                            @endforeach
                                            @endif
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
                                            <label><span>*</span>
                                                Product</label>
                                           <select name="productId" id="productId" class="select2" style="width: 100%;" onchange="getProductValue(this.value);getField(this.value)">
                                            <option value="">Select</option>
                                           
                                           </select>
                                           </div>
                                           <div class="col-md-2">
                                           <a href="{{route('addproduct')}}" class="btn btn-sm btn-info mt-3">Add</a>
                                           </div>
                                           </div>
                                        </div>
                                        <div id="productField">
                                        
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-10">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Stock Location <span id="brand_example"></span></label>
                                           <select name="stock_location_id" id="stock_location_id" class="form-control" style="width: 100%;">
                                            <option value="">Select</option>
                                            @if($data['stocklocation'])
                                            @foreach($data['stocklocation'] as $key)
                                            <option value="{{$key->id}}">{{$key->name}}</option>
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
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Type</label>
                                           <select name="type" id="type" class="form-control" onchange="getSaleType(this.value)">
                                           <option value="">Select</option>
                                           <option value="sale">Sale</option>
                                           <option value="purchase">Purchase</option>
                                           
                                           </select>
                                        </div>
                                        <div class="form-group" id="hideSaleType" style="display:none;">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Sale Type</label>
                                           <select name="sale_type" id="sale_type" class="form-control" onclick="changeSaleType(this.value)">
                                           <option value="">Select</option>
                                           <option value="1">Single Pieces</option>
                                           <option value="2">Whole Sell</option>
                                           </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span> Product Name</label>
                                            <input class="form-control" id="product_name" type="text"
                                                required="" name="product_name" autocomplete="off">
                                        </div>
                                         
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span> Quantity</label>
                                            <input class="form-control" id="quantity" type="text"
                                                required="" name="quantity">
                                        </div>

                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span> MRP</label>
                                            <input class="form-control"  type="text" id="mrp"
                                                required="" name="mrp">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span> Price <span id="perSaleType"></span></label>
                                            <input class="form-control"  type="text" id="price"
                                                required="" name="price">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0">Discount</span></label>
                                            <input class="form-control"  type="text" id="discount"
                                                name="discount">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0">Offer</span></label>
                                            <input class="form-control"  type="text" id="offer"
                                                name="offer">
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                            <div class="col-md-10">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                              Measure</label>
                                           <select name="weightId" id="weightId" class="form-control">
                                            <option value="">Select</option>
                                            @if($data['manufacture'])
                                            @foreach($data['manufacture'] as $key)
                                            <option value="{{$key->weightId}}">{{$key->weight}}</option>
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
                                            <input class="form-control"  type="text" name="length"
                                                required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span>Breadth</label>
                                            <input class="form-control"  type="text" name="breadth"
                                                required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span>Height</label>
                                            <input class="form-control"  type="text" name="height"
                                                required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0">Manufacture</label>
                                            <input class="form-control"  type="text" name="manufacture"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0">Supplier</label>
                                            <input class="form-control"  type="text" name="supplier"
                                               >
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"> UPC</label>
                                            <input class="form-control"  type="text" name="upc"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0">EAN</label>
                                            <input class="form-control"  type="text" name="ean"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span> GST(%)</label>
                                            <input class="form-control"  type="text" name="gst"
                                                required="">
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
                                           <select name="item_condition" id="item_condition" class="form-control" onchange="itemCondition(this.value)">
                                           <option value="">Select</option>
                                           <option value="new">New</option>
                                           <option value="used">Used</option>
                                          
                                           </select>
                                        </div>
                                        <div id="hideUsedItem" style="display:none;">
                                        <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                              Quality</label>
                                           <select name="quality" id="quality" class="form-control">
                                           <option value="">Select</option>
                                           <option value="good">Good</option>
                                           <option value="fair">Fair</option>
                                          
                                           </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Estimated Purchase Date</label>
                                            <input type="date" class="form-control" name="estimated_purchasedate" id="estimated_purchasedate">
                                        </div>
                                </div>
                                <div class="form-group mb-0">
                                            <div class="description-sm">
                                            <label class="col-form-label"><span>*</span>
                                            Specification</label>
                                                <textarea id="specification" name="specification" cols="10" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <div class="description-sm">
                                            <label class="col-form-label"><span>*</span>
                                            Description</label>
                                                <textarea id="description" name="description" cols="10" rows="4"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">
                                               Image</label>
                                            <input class="form-control" name="main_image" type="file" onchange="previewImage(event)">
                                            <br>
                                            <img id="main_image_preview" src="#" alt="Image Preview" style="display:none; max-height: 200px; margin-top:10px;" />
                                            <p id="showImg"></p>
                                            <input type="hidden" name="old_image" id="old_image">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">
                                               Other Image</label>
                                            <input class="form-control" name="other_image[]" type="file" multiple>
                                            <br>
                                            <p id="showOtherImg"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Shipping Included</label>
                                           <select name="shipping_included" id="shipping_included" class="form-control" required onchange="shippingInclude(this.value)">
                                           <option value="yes">Yes</option>
                                           <option value="no">No</option>
                                          
                                           </select>
                                        </div>
                                         <div class="form-group" id="hideKilometer">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Kilometer</label>
                                           <input type="text" class="form-control" name="kilometer" id="kilometer">
                                        </div>
                                        <div class="form-group" >
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Status</label>
                                           <select name="status" id="status" class="form-control" required>
                                           <option value="">Select</option>
                                           <option value="draft" >Save as Draft</option>
                                           <option value="published">Submit for Approval</option>
                                          
                                           </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Feature Product</label>
                                           <select name="type" id="feature_product" name="feature_product" class="form-control" required>
                                           <option value="">Select</option>
                                           <option value="1">Yes</option>
                                           <option value="0">No</option>
                                           
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
                        $("#mrp").val(result.mrp);
                        $("#price").val(result.price);
                        $("#discount").val(result.discount);
                        $("#offer").val(result.offer);
                         $("#description").val(result.description);
                         $("#slug_url").val(result.slug_url);
                         $("#showImg").html(result.img);
                         $("#old_image").val(result.main_image);
                         $("#showOtherImg").html(result.otherImg);
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
                       
                        $("#product_name").val('');
                        $("#mrp").val('');
                        $("#price").val('');
                        $("#discount").val('');
                        $("#offer").val('');
                         $("#currencyId").val('');
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

    function changeSaleType(val)
    {
        if(!val)
    {
        $('#perSaleType').html('');
        $('#location').hide();
    }
       if(val==1)
       {
        $('#perSaleType').html('(price per pieces)');
        $('#location').hide();
       }
       else if(val==2){
        $('#perSaleType').html('(price per Boxes)');
        $('#location').show();
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
                if (response.success) {  console.log("yes");
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