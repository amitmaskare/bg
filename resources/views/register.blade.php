@extends('layout.app')
@section('content')

 <!-- breadcrumb start -->
 <div class="breadcrumb-section">
        <div class="container">
            <h2>Create account</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{url('')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Create account</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--section start-->
    <section class="login-page section-b-space">
    <div class="container">
        <h3>Create Account</h3>
        <div class="theme-card">
     

<div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-md-12">
        @if (session('success'))
            <div class="alert alert-success" style="width:100%">
                {!! session('success') !!}
            </div>
        @endif
    </div>
<form method="POST" action="{{ route('saveRegister') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <label for="fname">First Name</label>
            <input type="text" name="fname" class="form-control" value="{{ old('fname') }}" required>
        </div>
        <div class="col-md-6">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" class="form-control" value="{{ old('lname') }}" required>
        </div>
       
    </div>
    <div class="row">
          <div class="col-md-6">
            <label for="lname">Phone</label>
            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
        </div>
        <div class="col-md-6">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
    </div>
    <div class="row">
        
        <div class="col-md-6">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
    </div><br><br>
    <button type="submit" class="btn btn-solid w-auto">Create Account</button>
</form>


        </div>
    </div>
</section>

    <!--Section ends-->


@endsection