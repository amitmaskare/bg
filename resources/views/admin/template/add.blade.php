@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>{{$data['heading']?? ''}}</h3>
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
                                    <li class="breadcrumb-item active">{{$data['heading']?? ''}}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    @if(Session::get('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @elseif(Session::get('error'))
                     <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif
                     @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li><p class="text-danger">{{ $error }}</p></li>
                                    @endforeach
                                </ul>
                                  </div>
                                  @endif
                    <form action="{{route('saveTemplate')}}" method="POST" enctype="multipart/form-data">
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
                                                    Template Name</label>
                                            <input type="text" class="form-control" name="template_name" id="template_name" value="">
                                              
                                            </div>
                                             <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                   Type</label>
                                           <select name="type" id="type" class="form-control">
                                            <option value="">Select</option>
                                            <option value="text">Text</option>
                                            <option value="media">Media</option>
                                           </select>
                                              
                                            </div>
                                             <div class="col-md-6 mt-3">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                   Langauge</label>
                                           <select name="language" id="language" class="form-control">
                                            <option value="">Select</option>
                                            <option value="english">English</option>
                                            <option value="hindi">Hindi</option>
                                           </select>
                                              
                                            </div>
                                              <div class="col-md-6 mt-3">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                   Status</label>
                                           <select name="status" id="status" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                           </select>
                                              
                                            </div>
                                            <input type="hidden" name="id" id="id" value="">
                                          
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                   <button type="submit" class="btn btn-warning">Submit</button>
                                   <a href="{{route('template')}}" class="btn btn-danger" >Cancel</a>
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

