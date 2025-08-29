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
                                        <a href="#">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Settings</li>
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
                        
                        <div class="col-xl-12">
                            <div class="card tab2-card">
                                <div class="card-body">
                                    <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" id="top-profile-tab"
                                                data-bs-toggle="tab" href="#top-profile" role="tab"
                                                aria-controls="top-profile" aria-selected="true"><i data-feather="user"
                                                    class="me-2"></i>Change Password</a>
                                        </li>
                                       
                                    </ul>
                                    <div class="tab-content" id="top-tabContent">
                                        <div class="tab-pane fade show active" id="top-profile" role="tabpanel"
                                            aria-labelledby="top-profile-tab">
                                        @if($errors->any())
                                    <div class="alert alert-danger">
                                              <ul>
                                     @foreach($errors->all() as $error)
                                             <li>{{ $error }}</li>
                                            @endforeach
                                            </ul>
                                         </div>
                                        @endif

                                           @if(session('success'))
                                           <div class="alert alert-success">{{session('success')}}</div>
                                           @elseif(session('error'))
                                            <div class="alert alert-danger">{{session('error')}}</div>
                                           @endif
                                            <form action="{{route('updatePassword')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                            <div class="table-responsive profile-table">
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td>Current Password:</td>
                                                            <td><input type="password" class="form-control" name="old_password" autocomplete="off"></td>
                                                        </tr>
                                                      
                                                        <tr>
                                                            <td>New Password:</td>
                                                            <td><input type="password" class="form-control" name="new_password" autocomplete="off"></td>
                                                        </tr>
                                                       
                                                        <tr>
                                                            <td>Confirm Password:</td>
                                                            <td><input type="password" name="confirm_password" class="form-control" autocomplete="off"></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td><button type="submit" class="btn btn-sm btn-info">Update</button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
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