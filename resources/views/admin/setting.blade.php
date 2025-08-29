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
                                                    class="me-2"></i>Logo Setting</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" id="contact-top-tab"
                                                data-bs-toggle="tab" href="#top-contact" role="tab"
                                                aria-controls="top-contact" aria-selected="false"><i
                                                    data-feather="settings" class="me-2"></i>Site Setting</a>
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
                                            <form action="{{route('logo_setting')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="table-responsive profile-table">
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>Website Name:</td>
                                                                <td><input type="text" class="form-control" name="website_name" autocomplete="off" value="{{ $data['setting']->website_name }}"></td>
                                                            </tr>

                                                            <!-- Logo File Upload -->
                                                            <tr>
                                                                <td>Logo:</td>
                                                                <td>
                                                                    <input type="file" class="form-control" name="logo" id="logo" autocomplete="off" onchange="previewLogo()" required>
                                                                    <!-- Preview the selected logo -->
                                                                    <div id="logo-preview">
                                                                        @if($data['setting']->logo)
                                                                            <img src="{{ asset('uploads/settings/' . $data['setting']->logo) }}" alt="Current Logo" class="img-thumbnail" width="100">
                                                                        @else
                                                                            <p>No logo uploaded</p>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td><input type="hidden" name="old_logo" value="{{ $data['setting']->logo }}"></td>
                                                            </tr>

                                                            <!-- Favicon File Upload -->
                                                            <tr>
                                                                <td>Favicon:</td>
                                                                <td>
                                                                    <input type="file" name="favicon" class="form-control" id="favicon" autocomplete="off" onchange="previewFavicon()" required>
                                                                    <!-- Preview the selected favicon -->
                                                                    <div id="favicon-preview">
                                                                        @if($data['setting']->favicon)
                                                                            <img src="{{ asset('uploads/settings/' . $data['setting']->favicon) }}" alt="Current Favicon" class="img-thumbnail" width="50">
                                                                        @else
                                                                            <p>No favicon uploaded</p>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td><input type="hidden" name="favicon_logo" value="{{ $data['setting']->favicon }}"></td>
                                                            </tr>

                                                            <input type="hidden" name="id" value="{{ $data['setting']->id }}">

                                                            <tr>
                                                                <td></td>
                                                                <td><button type="submit" class="btn btn-sm btn-info">Submit</button></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </form>
                                        </div>

                                         <div class="tab-pane fade" id="top-contact" role="tabpanel"
                                            aria-labelledby="contact-top-tab">
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
                                            <form action="{{route('site_setting')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                            <div class="table-responsive profile-table">
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td>Address:</td>
                                                            <td><input type="text" class="form-control" name="address" autocomplete="off" value="{{$data['setting']->address}}"></td>
                                                        </tr>
                                                      
                                                        <tr>
                                                            <td>Email:</td>
                                                            <td><input type="email" class="form-control" name="email" autocomplete="off" value="{{$data['setting']->email}}"></td>
                                                        </tr>
                                                       
                                                        <tr>
                                                            <td>Phone:</td>
                                                            <td><input type="text" name="phone" maxlength="10" class="form-control" autocomplete="off" value="{{$data['setting']->phone}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Facebook:</td>
                                                            <td><input type="text" name="facebook" class="form-control" autocomplete="off" value="{{$data['setting']->facebook}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Instagram:</td>
                                                            <td><input type="text" name="instagram" class="form-control" autocomplete="off" value="{{$data['setting']->instagram}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Twitter:</td>
                                                            <td><input type="text" name="twitter" class="form-control" autocomplete="off" value="{{$data['setting']->twitter}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Youtube:</td>
                                                            <td><input type="text" name="youtube" class="form-control" autocomplete="off" value="{{$data['setting']->youtube}}"></td>
                                                        </tr>
                                                        <input type="hidden"name="setting_id" value="{{$data['setting']->id}}">
                                                        <tr>
                                                            <td></td>
                                                            <td><button type="submit" class="btn btn-sm btn-info">Submit</button></td>
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

            <script>
    // Preview the logo image
    function previewLogo() {
        var logoInput = document.getElementById("logo");
        var logoPreview = document.getElementById("logo-preview");

        var file = logoInput.files[0];
        if (file) {
            var reader = new FileReader();

            reader.onload = function(e) {
                logoPreview.innerHTML = '<img src="' + e.target.result + '" alt="Logo Preview" class="img-thumbnail" width="100">';
            };

            reader.readAsDataURL(file);
        } else {
            // If no file is selected, show current logo or fallback message
            logoPreview.innerHTML = '<p>No logo uploaded</p>';
        }
    }

    // Preview the favicon image
    function previewFavicon() {
        var faviconInput = document.getElementById("favicon");
        var faviconPreview = document.getElementById("favicon-preview");

        var file = faviconInput.files[0];
        if (file) {
            var reader = new FileReader();

            reader.onload = function(e) {
                faviconPreview.innerHTML = '<img src="' + e.target.result + '" alt="Favicon Preview" class="img-thumbnail" width="50">';
            };

            reader.readAsDataURL(file);
        } else {
            // If no file is selected, show current favicon or fallback message
            faviconPreview.innerHTML = '<p>No favicon uploaded</p>';
        }
    }
</script>
@endsection