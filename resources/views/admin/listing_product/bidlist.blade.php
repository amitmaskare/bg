@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Listings
                                       
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="#">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Listing</li>
                                    <li class="breadcrumb-item active">List</li>
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
                            <a href="{{route('listingproduct')}}" class="btn btn-primary mt-3 mr-3" style="width:10%;">Back
                            </a>
                            <div class="card-body order-datatable">
                               
                               <table class="display basic-1">
                                   <thead>
                                       <tr>
                                           <th>#</th>
                                           <th>Bid Amount</th>
                                           <th>Quantity Requested</th> 
                                           <th>Status</th>
                                           <th>Bid Time</th>
                                           <th>Action</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                     
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


<script>
      function deleteListingProduct(id) {
           var ask=confirm("Are you sure want to delete ?");
           if(ask==true)
           {
            window.location.href = "{{ url('listingproduct/delete') }}" + '/' + id;

           }
                       
        }
</script>