@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Add Stock Location
                                       
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
                                    <li class="breadcrumb-item active">Add Stock Location</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <form action="{{route('package.save')}}" method="POST" enctype="multipart/form-data">
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
                                                   Type</label>
                                               <select name="type" id="type" class="form-control">
                                                <option value="">Select</option>
                                                <option value="1" {{ isset($data['package']) && $data['package']->type==1 ? 'selected':'' }}>Basic</option>
                                                <option value="2" {{ isset($data['package']) && $data['package']->type==2 ? 'selected':'' }}>Advanced</option>
                                                <option value="3" {{ isset($data['package']) && $data['package']->type==3 ? 'selected':'' }}>Pro</option>
                                               </select>
                                            </div>
                                           
                                                <div class="col-md-6 ">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Duration (Month)</label>
                                                <input type="text" name="duration"class="form-control" required value="{{ $data['package']->duration ?? ''}}">
                                            </div>
                                             <div class="col-md-6 mt-3">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Amount</label>
                                                <input type="text" name="amount"class="form-control" required value="{{ $data['package']->amount ?? ''}}">
                                            </div>

                                             <div class="col-md-6 mt-3">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Specification</label>
                                                <input type="text" name="specification"class="form-control" required value="{{ json_decode($data['package']->specification,true ) ?? ''}}">
                                            </div>
                                            <input type="hidden" name="packageId" value="{{ $data['package']->packageId ?? ''}}">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center mt-3">
                                    <button type="submit" class="btn btn-warning">Submit</button>
                                    <a href="{{route('package')}}" class="btn btn-danger">Cancel</a>
                                </div>
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

 
@endsection



