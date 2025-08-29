@extends('layout.admin')
@section('content')

            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Products
                                       
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="javascript:void(0)" >
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Physical</li>
                                    <li class="breadcrumb-item active">Product</li>
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
                                <div class="card-header">
                                     @admincan('product-create')
                                    <a href="{{route('addproduct')}}" class="btn btn-primary add-row mt-md-0 mt-2">Add
                                    Product</a>
                                     @endadmincan
                                </div>

                                <div class="card-body order-datatable table-responsive ">
                                <table class="display example_datatable">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>category</th>
                                                <th>Sub category</th>
                                                <th>Product Name</th>
                                                
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
 <script>
        var url = "{{route('product_ajax_manage_page') }}";
    var actioncolumn = 6;
    function deleteProduct(id) {
        if(confirm('Are you sure you want to delete this product?')) {
            window.location.href = "{{ url('admin/product/delete') }}/" + id;
        }
    }
</script>
@endsection

