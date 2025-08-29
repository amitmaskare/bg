@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                       <h2>{{ $employee ? 'Edit Employee' : 'Add Employee' }}</h2>
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
                                    <li class="breadcrumb-item active">{{ $employee ? 'Edit Employee' : 'Add Employee' }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                  @php
                        $isUpdate = isset($employee);
                    @endphp

                    <form action="{{ $isUpdate ? route('employee.update', $employee->id) : route('employee.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                      @if($employee)
                        @method('POST')
                    @endif
                    <div class="row product-adding">
                        <div class="col-xl-12">
                            <div class="card">
                                
                                <div class="card-body">
                                    <div class="digital-add needs-validation">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ old('name', $employee->name ?? '') }}" required>
                                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                             <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Email</label>
                                                <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email ?? '') }}" required>
                                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>

                                            <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Password</label>
                                                <input type="password" name="password" class="form-control" {{ $employee ? '' : 'required' }}>
                                                 @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                             <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Role</label>
                                                <select name="role_id" class="form-control" required>
                                                <option value="">Select Role</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->role_id }}" {{ (old('role_id', $employee->role_id ?? '') == $role->role_id) ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role_id') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                            
                                            <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Profile</label>
                                                
                                                <input type="file" name="profile" class="form-control">
                                                <br>
                                                 @if($employee && $employee->profile)
                                                    <img src="{{ asset('uploads/employee/' . $employee->profile) }}" width="100" class="mb-2">
                                                @endif
                                                @error('profile') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>

                                              <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Address</label>
                                                <input type="text" name="address" value="{{ old('address', $employee->address ?? '') }}" class="form-control" {{ $employee ? '' : 'required' }}>
                                                 @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                          <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Aadhar Card</label>
                                                <input type="text" name="adhaar_numer" maxlength="12" value="{{ old('adhaar_numer', $employee->adhaar_numer ?? '') }}" class="form-control" {{ $employee ? '' : 'required' }}>
                                                 @error('adhaar_numer') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                             <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Phone</label>
                                                <input type="text" maxlength="10" name="phone" value="{{ old('phone', $employee->phone ?? '') }}" class="form-control" {{ $employee ? '' : 'required' }}>
                                                 @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                              <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Emegency Contact</label>
                                                <input type="text" maxlength="10" value="{{ old('emerg_phone', $employee->emerg_phone ?? '') }}" name="emerg_phone" class="form-control" {{ $employee ? '' : 'required' }}>
                                                 @error('emerg_phone') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                               <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Postal Code</label>
                                                <input type="text" name="postal_code" value="{{ old('postal_code', $employee->postal_code ?? '') }}" class="form-control" {{ $employee ? '' : 'required' }}>
                                                 @error('postal_code') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                   <center> <button type="submit" class="btn btn-warning">{{ $employee ? 'Update' : 'Create' }}</button></center>
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

 
           
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
