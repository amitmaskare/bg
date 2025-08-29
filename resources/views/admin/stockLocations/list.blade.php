@extends('layout.admin')

@section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Stock Locations</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Stock Locations</li>
                        <li class="breadcrumb-item active">Stock Locations</li>
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                         @admincan('stocklocation-create')
                        <a href="{{ route('addstockLocations') }}" class="btn btn-primary add-row mt-md-0 mt-2">
                            Add Stock Locations
                        </a>
                         @endadmincan  
                    </div>

                    <div class="card-body order-datatable table-responsive">
                        <!-- DataTable for Stock Locations -->
                    <table class="display example_datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>City</th>
                                        <th>Postal Code</th>
                                        <th>Country</th>
                                        <th>Contact Information</th>
                                        <th>Status</th>
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
    var url = "{{route('stocklocation_ajax_manage_page') }}";
    var actioncolumn = 7;
</script>

