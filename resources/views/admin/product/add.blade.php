@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Add Products
                                       
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
                                    <li class="breadcrumb-item active">Add Product</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <form action="{{route('saveproduct')}}" method="post" enctype="multipart/form-data">
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
                                           <select name="categoryId" id="categoryId" class="form-control" onchange="getSubcategoryValue(this.value)">
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
                                           <select name="subcategoryId" id="subcategoryId" class="form-control" onchange="getField(this.value)">
                                            <option value="">Select</option>
                                            @if($data['subcategory'])
                                            @foreach($data['subcategory'] as $key)
                                            <option value="{{$key->subcategoryId}}">{{$key->name}}</option>
                                            @endforeach
                                            @endif
                                           </select>
                                    </div>
                                           <div class="col-md-2">
                                               <a href="{{route('addsubcategory')}}" class="btn btn-sm btn-primary mt-4"><i class="fa fa-plus"></i></a>
                                                </div>
                                                </div>
                                                </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-10">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                               Brand <span id="brand_example"></span></label>
                                           <select name="brandId" id="brandId" class="form-control">
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
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span> Product Line <span id="prod_example"></span></label>
                                            <input class="form-control" id="validationCustomtitle" type="text"
                                                required="" name="name">
                                        </div>
                                        <div id="productField">
                                        
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span> MRP</label>
                                            <input class="form-control"  type="text" required="" name="mrp">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0"><span>*</span> Price</label>
                                            <input class="form-control"  type="text" required="" name="price">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0">Discount</label>
                                            <input class="form-control"  type="text" name="discount">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustomtitle"
                                                class="col-form-label pt-0">Offer</label>
                                            <input class="form-control"  type="text" name="offer">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                              Currency</label>
                                           <select name="currencyId" id="currencyId" class="form-control">
                                            <option value="">Select</option>
                                            @if($data['currency'])
                                            @foreach($data['currency'] as $key)
                                            <option value="{{$key->id}}">{{$key->currency_name}}</option>
                                            @endforeach
                                            @endif
                                           </select>
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
                                            <label class="col-form-label">Specification</label>
                                            <textarea rows="5" cols="12" name="specification"></textarea>
                                        </div>
                                        <div class="form-group mb-0">
                                        <label class="col-form-label">Description</label>
                                            <div class="description-sm">
                                            <textarea id="editor1" name="description" cols="10" rows="4"></textarea>
                                                <!-- <textarea id="description" name="description" cols="10" rows="4"></textarea> -->
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label"><span>*</span>
                                               Image</label>
                                            <input class="form-control" name="main_image" type="file" required onchange="previewImage(event)">
                                            <br>
                                            <img id="main_image_preview" src="#" alt="Image Preview" style="display:none; max-height: 200px; margin-top:10px;" />
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label">
                                               Other Image</label>
                                            <input class="form-control" name="other_image[]" type="file" multiple>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="validationCustom02" class="col-form-label"><span>*</span>
                                               Video</label>
                                            <input class="form-control" name="video" type="file">
                                        </div> -->

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
@endsection


<script>
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

    function getField(subcategoryId)
    {
        $.ajax({
                    url: "{{ url('getadditionalfield') }}",
                    type: 'POST',
                    cache:false,
                    data: {
                         subcategoryId:subcategoryId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result)
                    {
                        $('#productField').html(result.html);
                        $('#brand_example').html(`(e.g. ${result.brand_example})`);
                        $('#prod_example').html(`(e.g. ${result.product_example})`);
                    }
                });
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
</script>

