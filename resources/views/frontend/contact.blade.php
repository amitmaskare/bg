@extends('layout.app')
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <h2>Contact us</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Contact us</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--contact section start-->
    <section class="contact-page">
        <div class="container">
            <div class="row g-sm-4 g-3">
                <div class="col-lg-5">
                    <div class="contact-title">
                        <h2>Get In Touch</h2>
                        <p>We're here to help! Reach out to us with any questions, feedback, or inquiries, and we'll get
                            back to you as soon as possible.</p>
                    </div>
                </div>
                <div class="col-lg-7">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form class="theme-form contact-form" method="POST" action="{{ route('contact.store') }}">
    @csrf
    <div class="row g-4">
        <div class="col-12">
            <div class="form-box">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" name="full_name" class="form-control" placeholder="Full Name">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-box">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter Your Phone Number">
            </div>
        </div>
        <div class="col-12">
            <div class="form-box">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject">
            </div>
        </div>
        <div class="col-12">
            <div class="form-box">
                <label for="message">Write Your Message</label>
                <textarea rows="6" name="message" class="form-control" placeholder="Write Your Message"></textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="form-box">
                <button class="btn btn-solid" type="submit">Send Your Message</button>
            </div>
        </div>
    </div>
</form>
                </div>
                <div class="col-12">
                    <div class="contact-right">
                        <ul>
                            <li>
                                <div class="contact-icon">
                                    <i class="ri-phone-fill"></i>
                                </div>
                                <div class="media-body">
                                    <h6>Contact Us</h6>
                                    <p>{{$settings->phone}}</p>
                                </div>
                            </li>
                            <li>
                                <div class="contact-icon">
                                    <i class="ri-map-pin-fill"></i>
                                </div>
                                <div class="media-body">
                                    <h6>Address</h6>
                                    <p>{{$settings->address}}</p>
                                </div>
                            </li>
                            <li>
                                <div class="contact-icon">
                                    <i class="ri-mail-fill"></i>
                                </div>
                                <div class="media-body">
                                    <h6>Email</h6>
                                    <p>{{$settings->email}}</p>
                                </div>
                            </li>
                            <li>
                                <div class="contact-icon">
                                    <i class="ri-cellphone-fill"></i>
                                </div>
                                <div class="media-body">
                                    <h6>Website Name</h6>
                                    <p>{{$settings->website_name}}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--contact section ends-->


    <!-- map section start -->
    <section class="map-section">
        <iframe
  width="100%"
  height="450"
  frameborder="0"
  style="border:0"
  src="https://www.google.com/maps?q={{ urlencode($settings->address) }}&output=embed"
  allowfullscreen>
</iframe>
    </section>
    <!-- map section End -->
@endsection