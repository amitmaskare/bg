@extends('layout.admin')
@section('content')



            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>{{$data['heading']}}</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="javascript:void(0)" >
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Physical</li>
                                    <li class="breadcrumb-item active">{{$data['heading']}}</li>
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
                                <div class="card-header">
                                     @admincan('template-create')
                                    <a href="{{ route('template.add')}}" class="btn btn-primary add-row mt-md-0 mt-2">Add</a>
                                   @endadmincan  
                                </div>
                            @if(Session::get('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif

                                <div class="card-body order-datatable">
                                <table class="display basic-1">
                                            <thead>
                                            <tr>
                    <th>#</th>
                    <th>Template Name</th>
                    <th>Action</th>
                  </tr>
                                            </thead>

                                            <tbody>
                                        @if(!$data['template']->isEmpty())
                                        @foreach($data['template'] as $index=>$value)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$value->template_name}}</td>
                                            <td>
            <a href="{{ route('template.edit', $value->id) }}" class="btn btn-success btn-sm me-2">Edit</a>

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
            @endsection