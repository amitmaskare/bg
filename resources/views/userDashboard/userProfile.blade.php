@extends('layout.app')
@section('content')

<style>
    .show-on-top {
    position: absolute !important;
    top: 100%;
    left: 0;
    z-index: 9999;
    display: none;
}

/* Show when parent has .show */
.dropdown.show .show-on-top {
    display: block;
}
</style>




    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <h2>Dashboard</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space user-dashboard-section">
        <div class="container">
            <div class="row">
                 @include('userDashboard.sidebar')
            <div class="col-lg-9">
                <button class="show-btn btn d-lg-none d-block">Show Menu</button>
                <div class="faq-content tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="profileInfo-tab-pane" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-0 mt-0">
                                    <div class="card-body">

                                        <div class="accordion accordion-flush product-accordion" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                        aria-expanded="false" aria-controls="flush-collapseOne">
                                                        Profile Information </button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        
                                                    <div class="top-sec">
                                                        <h3>Profile Information</h3>
                                                        <!-- <a href="#add-address" data-bs-toggle="modal"
                                                            class="btn btn-sm btn-solid">+ Add New</a> -->
                                                    </div>
                                                <div class="address-book-section">
                                                    <form method="POST" id="profileForms" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label for="fname">Full Name</label>
                                                                    <input type="text" name="name" id="name1" class="form-control" value="{{$data['user']->name ?? ''}}" required>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="fname">Mobile Number</label>
                                                                    <input type="text" name="phone_number" id="phone_number1" class="form-control" value="{{$data['user']->phone_number ?? ''}}" >
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="email">Email</label>
                                                                    <input type="email" name="email" id="email1" class="form-control" value="{{$data['user']->email ?? ''}}" required readonly>
                                                                </div>
                                                            </div>
                                                             <div class="col-md-4 mt-3">
                                                                    <label for="email">Wallet</label>
                                                                    <input type="number" name="wallet" id="wallet" class="form-control" value="{{$data['user']->wallet ?? ''}}" required >
                                                                </div>
                                                            </div>
                                                            
                                                            <button type="button" id="saveBtn" class="btn btn-solid w-auto mt-3">Update Profile</button>
                                                        </form>

                                                    </div>
                                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            </div>
                                        </div>
                                        <br>
                                        <div class="accordion accordion-flush product-accordion" id="accordionFlushExample1">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne1"
                                                        aria-expanded="false" aria-controls="flush-collapseOne">
                                                        Change Password </button>
                                                </h2>
                                                <div id="flush-collapseOne1" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordionFlushExample1">
                                                    <div class="accordion-body">
                                                        
                                                    <div class="top-sec">
                                                        <h3>Change Password</h3>
                                                        <!-- <a href="#add-address" data-bs-toggle="modal"
                                                            class="btn btn-sm btn-solid">+ Add New</a> -->
                                                    </div>
                                                    <div class="address-book-section">
                                            <form method="POST" id="changepassword" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="fname">Current Password</label>
                                                            <input type="password" name="current_password" placeholder="Enter Current Password" id="current_password" class="form-control" value="" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="fname">New Password</label>
                                                            <input type="password" name="password" id="new_password" placeholder="Enter New Password" class="form-control" value="" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="">Confirm password</label>
                                                            <input type="password" name="confpassword" id="confpassword" placeholder="Confirm  Password" class="form-control" value="" required >
                                                        </div>
                                                    </div><br>
                                                   <br><br>
                                                    <button type="button" id="changePassword" class="btn btn-solid w-auto">Change Password</button>
                                                </form>

                                            </div>
                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            </div>
                                        </div>
                            </div>
                        </div>
                     
                        <div class="tab-pane fade" id="addAddress" role="tabpanel">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mb-0 mt-0">
                                        <div class="card-body">
                                            <div class="top-sec d-flex justify-content-between align-items-center">
                                                <h3>Manage Addresses</h3>
                                                <button type="button" class="btn btn-sm btn-solid" data-bs-toggle="collapse" data-bs-target="#addAddressForm">
                                                    + Add New Address
                                                </button>
                                            </div>

                                            <!-- Add/Edit Address Form -->
                                            <div class="collapse mt-3" id="addAddressForm">
                                                <form id="addAddressFormReal">
                                                    @csrf
                                                    <input type="hidden" id="edit_address_id">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Address Line</label>
                                                            <input type="text" id="address_line" class="form-control" placeholder="123 Main Street" required>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>City</label>
                                                            <input type="text" id="city" class="form-control" placeholder="City" required>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Postal Code</label>
                                                            <input type="text" id="postal_code" class="form-control" placeholder="123456" required>
                                                        </div>
                                                        <div class="col-md-4 mt-2">
                                                            <label>State</label>
                                                            <input type="text" id="state" class="form-control" placeholder="State">
                                                        </div>
                                                        <div class="col-md-4 mt-2">
                                                            <label>Country</label>
                                                            <input type="text" id="country" class="form-control" placeholder="Country">
                                                        </div>
                                                        <div class="col-md-4 mt-2">
                                                            <label>Address Type</label>
                                                            <select id="type" class="form-control">
                                                                <option value="home">Home</option>
                                                                <option value="work">Work</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <button type="button" class="btn btn-solid" id="saveAddressBtn">Save Address</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <!-- Address List -->
                                            <div class="address-book-section mt-5">
                                                <div class="row" id="addressList">
                                                    @foreach($data['addresses'] as $address)
                                                        <div class="col-md-6 mb-3" id="address-{{ $address->id }}">
                                                            <div class="card" style="background-color:#fff;border:none;padding:10px">
                                                                <h6 style="font-weight:600;">{{ ucfirst($address->type) }} Address</h6>
                                                                <p>
                                                                    {{ $address->address_line }}, {{ $address->city }}, {{ $address->state }},
                                                                    {{ $address->postal_code }}, {{ $address->country }}
                                                                </p>
                                                                <div class="d-flex gap-2">
                                                                    <button class="btn btn-sm btn-warning" onclick="editAddress({{ $address->id }})">Edit</button>
                                                                    <button class="btn btn-sm btn-danger" onclick="deleteAddress({{ $address->id }})">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div><!-- End address list -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="order-tab-pane" role="tabpanel">
                            <div class="row">
                                <div class="card mb-0 dashboard-table mt-0">
                                    <div class="card-body">
                                        <div class="top-sec">
                                            <h3>My Orders</h3>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary">Visit Seller Dashboard</a>
                                        </div>
                                        <div class="total-box mt-0">
                                            <div class="wallet-table mt-0">
                                                <div class="table-responsive">
                                                    <table class="table cart-table order-table">
                                                        <thead>
                                                            <tr class="table-head">
                                                                <th>Order Number</th>
                                                                <th>Date</th>
                                                                <th>Amount</th>
                                                                <th>Payment Status</th>
                                                                <th>Payment Method</th>
                                                                <th>Option</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           
                                                            <tr>
                                                                <td><span class="fw-bolder">#1012</span></td>
                                                                <td>21 Jun 2024 05:18:PM
                                                                </td>
                                                                <td>$6.23</td>
                                                                <td>
                                                                    <div
                                                                        class="badge bg-pending custom-badge rounded-0">
                                                                        <span>Pending</span>
                                                                    </div>
                                                                </td>
                                                                <td>COD</td>
                                                                <td><a href="#!"><i class="ri-eye-line"></i></a></td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="product-pagination">
                                                <div class="theme-paggination-block">
                                                    <nav>
                                                        <ul class="pagination">
                                                            <li class="page-item">
                                                                <a class="page-link" href="#!" aria-label="Previous">
                                                                    <span>
                                                                        <i class="ri-arrow-left-s-line"></i>
                                                                    </span>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                            </li>
                                                            <li class="page-item active">
                                                                <a class="page-link" href="#!">1</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a class="page-link" href="#!">2</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a class="page-link" href="#!">3</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a class="page-link" href="#!" aria-label="Next">
                                                                    <span>
                                                                        <i class="ri-arrow-right-s-line"></i>
                                                                    </span>
                                                                    <span class="sr-only">Next</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                              
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  dashboard section end -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
   
    $('#saveBtn').on('click', function(e) {
    e.preventDefault();  // Keep this to stop default form submission

    let name = $('#name1').val();
    let phone = $('#phone_number1').val(); // ✅ .val() was missing
    let email = $('#email1').val();
    let wallet = $('#wallet').val();
   
    if (!name || !phone || !email || !wallet) {
        alert("All fields are required.");
        return;
    }

    $.ajax({
        url: "{{ route('saveprofileData') }}",
        method: "POST",
        data: {
            name: name,
            phone_number: phone, // Make sure this key matches Laravel validation
            email: email,
            wallet: wallet,
        },
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(response) {
            alert(response.message);
        },
        error: function(xhr) {
            console.log(xhr.responseJSON);
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let message = Object.values(errors).flat().join("\n");
                alert("Validation errors:\n" + message);
            } else {
                alert("An error occurred. Please try again.");
            }
        }
    });
});


$('#changePassword').on('click', function(e) {
        e.preventDefault();

        let currentPassword = $('#current_password').val();
        let newPassword = $('#new_password').val();
        let confPassword = $('#confpassword').val();

        if (!currentPassword || !newPassword || !confPassword) {
            alert("All fields are required.");
            return;
        }
        if (!currentPassword) {
            alert("Current Password  are required.");
            return;
        }
        if (newPassword !== confPassword) {
            alert("New password and confirm password do not match.");
            return;
        }

        $.ajax({
            url: "{{ route('updatePassword') }}", // Set this route in web.php
            method: "POST",
            data: {
                current_password: currentPassword,
                new_password: newPassword,
                confpassword: confPassword
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                
                alert(response.message);
                $('#changepassword')[0].reset();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let message = Object.values(errors).flat().join("\n");
                    alert("Validation errors:\n" + message);
                } else {
                    alert("An error occurred. Please try again.");
                }
            }
        });
    });

</script>

@endsection