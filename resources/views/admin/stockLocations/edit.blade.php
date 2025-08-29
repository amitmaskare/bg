@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Edit Stock Location
                                       
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
                                    <li class="breadcrumb-item active">Edit Stock Location</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('updatestockLocations')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row product-adding">
                        <div class="col-xl-12">
                            <div class="card">
                        
                                <div class="card-body">
                                    <div class="digital-add needs-validation">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Nmae</label>
                                                <input type="text" name="name"class="form-control" value="{{$StockLocation->name}}" required>
                                            </div>
                                            <input type="hidden" name="id" value="{{$StockLocation->id}}" >
                                            <div class="col-md-6">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                Address</label>
                                                <textarea name="address">{{$StockLocation->address}}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                    <label for="validationCustomtitle" class="col-form-label pt-0"><span>*</span>
                                                        Country <span id="brand_example"></span></label>
                                                    <select  name="country" class="form-control" readonly>
                                                        <!-- <option value="">Select</option> -->
                                                        @foreach($countries as $country)
                                                    
                                                        <option value="{{ $country->countryName }}" {{ (isset($StockLocation) && $StockLocation->country == $country->countryName) ? 'selected' : '' }}>{{ $country->countryName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="validationCustomtitle" class="col-form-label pt-0"><span>*</span>
                                                        State <span id="brand_example"></span></label>
                                                    <select  name="state" class="form-control" readonly>
                                                        <!-- <option value="">Select</option> -->
                                                        @foreach($state as $state)
                                                            <option value="{{$state->stateName }}" {{ (isset($StockLocation) && $StockLocation->state == $state->stateName) ? 'selected' : '' }}>{{$state->stateName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                        City <span id="brand_example"></span></label>
                                                    <select name="city" id="city" class="form-control">
                                                        <option value="">Select</option>
                                                        @foreach($cities as $city)
                                                            <option value="{{ $city->cityName }}" {{ (isset($StockLocation) && $StockLocation->city == $city->cityName) ? 'selected' : '' }}>{{ $city->cityName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                        Direction <span id="brand_example"></span></label>
                                                    <select name="direction" id="direction" class="form-control">
                                                        <option value="">Select</option>
                                                        @foreach($Direction as $Direction)
                                                            <option value="{{ $Direction }}" {{ (isset($StockLocation) && $StockLocation->direction == $Direction) ? 'selected' : '' }}   >{{ $Direction }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                             
                                           
                                                <input type="hidden" value="{{$StockLocation->sellerID}}" name="sellerID" >
                                               
                                                <div class="col-md-6">
                                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Contact Info</label>
                                                    <textarea name="contact_information" >{{$StockLocation->contactInformation}}</textarea>
                                                </div>

                                                <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Postal Code</label>
                                                <input type="text" name="postal_code"class="form-control" value="{{$StockLocation->postal_code}}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                   <center> <button type="submit" class="btn btn-warning">Submit</button></center>
                                </div>
                            </div>
                                        
                          
                                             
                        </div>
                    </div>
                </div>
            </div>
                      <!--   <div class="col-xl-6">
                            <div class="card">
                               
                                <div class="card-body">
                                    <div class="digital-add needs-validation">
                                  

                                      

                                    </div>
                                </div>
                            </div>
                           
                        </div> -->
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
                        $('#brand_example').html(`(${result.brand_example})`);
                        $('#prod_example').html(`(${result.product_example})`);
                    }
                });
    }

    function deleteImg(id) {
           var ask=confirm("Are you sure want to delete ?");
           if(ask==true)
           {
            $.ajax({
        type:"POST",
        url:"{{ url('product/deleteImg') }}",
        data:{
            id:id,
             _token: '{{ csrf_token() }}',
        },
        cache:false,
        success:function(returndata)
        {
         $('#deleteImg'+id).fadeOut('fast');
        }
      });
           // window.location.href = "{{ url('product/deleteImg') }}" + '/' + id;
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
<script>
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
