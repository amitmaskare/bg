@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>View Product
                                       
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
                                    <li class="breadcrumb-item active">View Product</li>
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
                   
                    <div class="card-body">
                        <div class="digital-add needs-validation">
                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-12">
                                <label class="col-form-label pt-0">  Category</label>
                                <select name="categoryId" id="categoryId" class="form-control" onchange="getSubcategoryValue(this.value)" disabled>
                                    <option value="">Select</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->categoryId }}" {{ $product->categoryId == $category->categoryId ? 'selected' : '' }}>
                                            {{ $category->categoryName }}
                                        </option>
                                    @endforeach
                                </select>
                                </div>
                                        </div>
                            </div>
                            <div class="form-group">
                                        <div class="row">
                                        <div class="col-md-12">
                                            <label for="validationCustom01" class="col-form-label pt-0"> 
                                               Sub Category</label>
                                               <select name="subcategoryId" id="subcategoryId" class="form-control" onchange="getField(this.value)" disabled>
                                    <option value="">Select</option>
                                    @foreach($subcategories as $subcategory)
                                        <option value="{{ $subcategory->subcategoryId }}" {{ $product->subcategoryId == $subcategory->subcategoryId ? 'selected' : '' }}>
                                            {{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                                    </div>
                            </div>
                        </div>
                          
                    <div class="form-group">
                            <div class="row">
                            <div class="col-md-12">
                                <label class="col-form-label pt-0">  Brand <span id="brand_example"></span></label>
                                <select name="brandId" id="brandId" class="form-control" disabled>
                                    <option value="">Select</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->brandId }}" {{ $product->brandId == $brand->brandId ? 'selected' : '' }}>
                                            {{ $brand->brand_name }}
                                        </option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                                <label class="col-form-label pt-0">  Product Name <span id="prod_example"></span></label>
                                <input class="form-control" type="text" name="name" value="{{ $product->name }}" required disabled>
                            </div>
                            <div id="productField">
                            @php 
                                $valueField = json_decode($product->additional_fields ?? '{}', true); 
                                                    @endphp
                                                    @if($fields)
                                @foreach($fields as $key)
                                    @php
                                    $required = ($key->is_required == '2') ? 'required' : '';
                                    $validation = ($key->is_required == '2') ? '*' : '';
                                        $fieldName = $key->field_name;
                                        $fieldValue = $valueField[$fieldName] ?? ''; 
                                        $value = is_array($fieldValue) ? ($fieldValue[0] ?? '') : $fieldValue;
                                    
                                @endphp

       
    @endforeach
@endif

        </div>
        
        <div class="form-group">
            <label class="col-form-label pt-0">  Price</label>
            <input class="form-control" type="text" name="price" value="{{ $product->price }}" required disabled>
        </div>
        <div class="form-group">
                        <label for="validationCustom01" class="col-form-label pt-0"> 
                            Currency</label>
                        <select name="currencyId" id="currencyId" class="form-control" disabled>
                      
                        @if($currency)
                        @foreach($currency as $key)
                        <option value="{{$key->id}}" {{ $product->currencyId == $key->id ? 'selected' : '' }}>{{$key->currency_name}}</option>
                        @endforeach
                    @endif
                </select>
                            </div>
                            
                            <div class="form-group">
                            <div class="row">
                            <div class="col-md-12">
                                <label for="validationCustom01" class="col-form-label pt-0"> 
                                    Measure</label>
                                <select name="weightId" id="weightId" class="form-control" disabled>
                                <option value="">Select</option>
                                @if($manufacture)
                                @foreach($manufacture as $key)
                                <option value="{{$key->weightId}}"  {{ $product->weightId == $key->weightId ? 'selected' : '' }}>{{$key->weight}}</option>
                                @endforeach
                                @endif
                                </select>
                                </div>
                        
                            </div>
                            </div>

                            <div class="form-group">
                                <label for="validationCustomtitle"
                                    class="col-form-label pt-0">  Length</label>
                                <input class="form-control"  type="text" name="length"
                                    required="" value="{{$product->length}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="validationCustomtitle"
                                    class="col-form-label pt-0"> Breadth</label>
                                <input class="form-control"  type="text" name="breadth"
                                    required="" value="{{$product->breadth}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="validationCustomtitle"
                                    class="col-form-label pt-0"> Height</label>
                                <input class="form-control"  type="text" name="height"
                                    required="" value="{{$product->height}}" disabled>
                            </div>

                <div class="form-group">
                    <label class="col-form-label pt-0">Manufacture</label>
                    <input class="form-control" type="text" name="manufacture" value="{{ $product->manufacture }}" disabled>
                </div>

                <div class="form-group">
                    <label class="col-form-label pt-0">Supplier</label>
                    <input class="form-control" type="text" name="supplier" value="{{ $product->supplier }}" disabled>
                </div>

                <div class="form-group">
                    <label class="col-form-label pt-0"> UPC</label>
                    <input class="form-control" type="text" name="upc" value="{{ $product->upc }}" disabled>
                </div>

                <div class="form-group">
                    <label class="col-form-label pt-0">EAN</label>
                    <input class="form-control" type="text" name="ean" value="{{ $product->ean }}" disabled>
                </div>

                <div class="form-group">
                    <label class="col-form-label pt-0">  GST</label>
                    <input class="form-control" type="text" name="gst" value="{{ $product->gst }}" required disabled>
                </div>
            </div>
        </div>
    </div>
</div>

            <!-- Right side -->
            <div class="col-xl-6">
                <div class="card">
                   
                    <div class="card-body">
                    <a href="{{url('product')}}" class="btn btn-warning">Back</a>
                        <div class="digital-add needs-validation">
                            <div class="form-group">
                                <label class="col-form-label">Specification</label>
                                <textarea rows="5" cols="12" name="specification" disabled>{{ $product->specification }}</textarea>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Description</label>
                                <textarea id="description" name="description" cols="10" rows="4" disabled> {{ $product->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label"> Main Image</label><br>
                                <img src="{{ asset('uploads/product/' . $product->main_image) }}" alt="Product Image" width="100px" height="100px">
                             
                            </div>

                           
                      
                        </div>
                    </div>
                </div>
            </div>

        </div>
   
</div>

                <!-- Container-fluid Ends-->
            </div>


@endsection


