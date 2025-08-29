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
                        <a href="index.html">Home</a>
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
                        <div class="tab-pane fade show active" id="info-tab-pane" role="tabpanel">
                            <div class="counter-section">
                                <div class="welcome-msg">
                                    <h4>Hello, {{ucfirst($data['user']->name) ?? ''}} !</h4>
                                  
                                </div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <a href="{{route('myBidInfo')}}">
                                        <div class="counter-box">
                                            <img src="../assets/images/dashboard/balance.png" alt="" class="img-fluid">
                                            <div>
                                                <h3>{{count($data['bid']) ?? 0 }}</h3>
                                                <h5>Total Bids</h5>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                         <a href="{{route('myOrderInfo')}}">
                                        <div class="counter-box">
                                            <img src="../assets/images/dashboard/balance.png" alt="" class="img-fluid">
                                            <div>
                                                <h3>0</h3>
                                                <h5>Total Sales Orders</h5>
                                            </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col-md-4">
                                         <a href="{{route('purchaseOrder')}}">
                                        <div class="counter-box">
                                            <img src="../assets/images/dashboard/points.png" alt="" class="img-fluid">
                                            <div>
                                                <h3>0</h3>
                                                <h5>Total Purchase Orders</h5>
                                            </div>
                                        </div>
                                            </a>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                          <a href="{{route('mywishList')}}">
                                        <div class="counter-box">
                                            <img src="../assets/images/dashboard/order.png" alt="" class="img-fluid">
                                            <div>
                                                <h3>0</h3>
                                                <h5>Total Wishlist</h5>
                                            </div>
                                        </div>
                                    </a>
                                    </div>

                                     <div class="col-md-4 mt-3">
                                         <a href="{{route('mywalletList')}}">
                                        <div class="counter-box">
                                            <img src="../assets/images/dashboard/order.png" alt="" class="img-fluid">
                                            <div>
                                                <h3>0</h3>
                                                <h5>Total Wallet</h5>
                                            </div>
                                        </div>
                                        </a>
                                    </div>

                                     <div class="col-md-4 mt-3">
                                         <a href="{{route('mytransactionList')}}">
                                        <div class="counter-box">
                                            <img src="../assets/images/dashboard/order.png" alt="" class="img-fluid">
                                            <div>
                                                <h3>0</h3>
                                                <h5>Total Transaction</h5>
                                            </div>
                                        </div>
                                    </aa>
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
    $(document).ready(function() {
        $('.change-status').on('click', function() {
      
            var bidId = $(this).data('id');  
            var status = $(this).data('status'); 
            
            $.ajax({
                url: "{{ route('bid.updateStatus', ['id' => '__ID__']) }}".replace('__ID__', bidId), 
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',  
                    status: status  
                },
                success: function(response) {
                    if(response.success) {
                        alert('Status updated successfully!');
                        location.reload(); // Optionally reload to reflect the change in status
                    } else {
                        alert('There was an issue updating the status.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + error);
                    alert('An error occurred.');
                }
            });
        });
    });


    $('#saveBtn').on('click', function(e) {
    e.preventDefault();  // Keep this to stop default form submission

    // Get values from form fields
    let name = $('#name1').val();
    let phone = $('#phone_number1').val(); // ✅ .val() was missing
    let email = $('#email1').val();
    let address = $('#address1').val();
    let state = $('#state1').val();
    let pincode = $('#pincode1').val();

    // Check for empty fields
    if (!name || !phone || !email || !address || !state || !pincode) {
        alert("All fields are required.");
        return;
    }

    $.ajax({
        url: "{{ route('saveprofileData') }}",
        method: "POST",
        data: {
            name: name,
            phone_number: phone, 
            email: email,
            address: address,
            state: state,
            pincode: pincode
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



//     $('#saveAddressBtn').on('click', function(e) {
//     e.preventDefault();

//     let addressLine = $('#address_line').val();
//     let city = $('#city').val();
//     let postalCode = $('#postal_code').val();
//     let state = $('#state').val();
//     let country = $('#country').val();
//     let type = $('#type').val();

//     // Basic validation
//     if (!addressLine || !city || !postalCode || !country) {
//         alert("Please fill all required fields.");
//         return;
//     }

//     $.ajax({
//         url: "{{ route('addresses.store') }}",
//         method: "POST",
//         data: {
//             address_line: addressLine,
//             city: city,
//             postal_code: postalCode,
//             state: state,
//             country: country,
//             type: type
//         },
//         headers: {
//             'X-CSRF-TOKEN': '{{ csrf_token() }}'
//         },
//         success: function(response) {
//             if (response.success) {
//                 alert(response.message);
//                 $('#addAddressFormReal')[0].reset();

//                 let newAddressHTML = `
//                     <div class="col-md-6 mb-3"  id="address-${response.newAddress.id}">
//                         <div class="card" style="background-color:#fff;border:none;padding:10px"">
//                             <h6 style="font-weight:600;">${response.newAddress.type.charAt(0).toUpperCase() + response.newAddress.type.slice(1)} Address</h6>
//                             <p>
//                                 ${response.newAddress.address_line}, ${response.newAddress.city}, ${response.newAddress.state}, ${response.newAddress.postal_code}, ${response.newAddress.country}
//                             </p>
//                             <button class="btn btn-sm btn-danger" onclick="deleteAddress(${response.newAddress.id})">Delete</button>
//                         </div>
//                     </div>
//                 `;

//                 $('#addressList').append(newAddressHTML);
//             } else {
//                 alert("Failed to save address. " + response.message);
//             }
//         },
//         error: function(xhr) {
//             if (xhr.status === 422) {
//                 let errors = xhr.responseJSON.errors;
//                 let message = Object.values(errors).flat().join("\n");
//                 alert("Validation errors:\n" + message);
//             } else {
//                 alert("An error occurred. Please try again.");
//             }
//         }
//     });
// });


// Edit button click - fetch address data
function editAddress(id) {
    $.ajax({
        url: `/addresses/${id}`,
        method: 'GET',
        success: function(response) {
            if (response.success) {
                const a = response.address;
                $('#edit_address_id').val(a.id);
                $('#address_line').val(a.address_line);
                $('#city').val(a.city);
                $('#postal_code').val(a.postal_code);
                $('#state').val(a.state);
                $('#country').val(a.country);
                $('#type').val(a.type);

                // Show form
                new bootstrap.Collapse(document.getElementById('addAddressForm')).show();
                $('#saveAddressBtn').text('Update Address');
            } else {
                alert('Address not found.');
            }
        },
        error: function() {
            alert('Error loading address.');
        }
    });
}
$('#saveAddressBtn').on('click', function () {
    const id = $('#edit_address_id').val();
    const data = {
        address_line: $('#address_line').val(),
        city: $('#city').val(),
        postal_code: $('#postal_code').val(),
        state: $('#state').val(),
        country: $('#country').val(),
        type: $('#type').val()
    };

    const url = id ? `/addresses/${id}` : "{{ route('addresses.store') }}";
    const method = id ? 'PUT' : 'POST';

    $.ajax({
        url: url,
        method: method,
        data: data,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(response) {
            alert(response.message);
            $('#addAddressFormReal')[0].reset();
            $('#edit_address_id').val('');
            $('#saveAddressBtn').text('Save Address');
            location.reload(); // Or re-render dynamically
        },
        error: function(xhr) {
            alert('Failed to save address.');
        }
    });
});
function deleteAddress(id) {
    if (!confirm("Are you sure you want to delete this address?")) return;

    $.ajax({
        url: `/addresses/${id}`,
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                $(`#address-${id}`).remove();
                alert(response.message);
            } else {
                alert('Failed to delete address.');
            }
        },
        error: function() {
            alert('An error occurred while deleting the address.');
        }
    });
}
document.addEventListener("DOMContentLoaded", function () {
    // Get and activate the last active tab
    const lastTabId = localStorage.getItem("activeTabId");
    if (lastTabId) {
        const lastTabBtn = document.querySelector(`[data-bs-target="${lastTabId}"]`);
        if (lastTabBtn) {
            const tab = new bootstrap.Tab(lastTabBtn);
            tab.show();
        }
    }

    // When tab is changed, save the new tab id
    const tabButtons = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabButtons.forEach((btn) => {
        btn.addEventListener("shown.bs.tab", function (event) {
            const targetId = event.target.getAttribute("data-bs-target");
            localStorage.setItem("activeTabId", targetId);
        });
    });
});
</script>
</script>
@endsection