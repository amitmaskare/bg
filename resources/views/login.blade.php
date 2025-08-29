@extends('layout.app')
@section('content')

 <!-- breadcrumb start -->
   <!-- breadcrumb start -->
   <div class="breadcrumb-section">
        <div class="container">
            <h2>Customer's login</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{url('')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Customer's login</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--section start-->
    <section class="login-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Login</h3>
                    <div class="theme-card">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div style="text-align:center;">
                    <a href="javascript:void(0);" class="login-google btn btn-solid" id="google-login-btn">
                        <img src="{{asset('assets/images/google-fill.svg')}}" width="20" height="20" alt="google login" class="me-2">
                        Continue with Google
                    </a>
                    </div>
                    <br/>
                    <form method="POST" action="{{ route('auth.loginuser') }}"  class="theme-form">
                        @csrf
                        <div class="form-box">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" required value="{{ old('email') }}">
                        </div>
                        <div class="form-box">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                        </div>
                        <button type="submit" class="btn btn-solid">Login</button>
                    </form>
                    
                    </div>
                </div>
                <div class="col-lg-6 right-login">
                    <h3>New Customer</h3>
                    <div class="theme-card authentication-right">
                        <h6 class="title-font">Create A Account</h6>
                        <p>Sign up for a free account at our store. Registration is quick and easy. It allows you to be
                            able to order from our shop. To start shopping click register.</p>
                        <a href="{{route('register')}}" class="btn btn-solid">Create an Account</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->


@endsection