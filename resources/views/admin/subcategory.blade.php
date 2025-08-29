@extends('layout.admin')
@section('content')



            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Sub Category
                                       
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
                                    <li class="breadcrumb-item active">Category</li>
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
                              @if(session('success'))
                              <div class="alert alert-success">{{session('success')}}</div>
                              @endif
                                <div class="card-header">
                                     @admincan('subcategory-create')
                                    <a href="{{route('addsubcategory')}}" class="btn btn-primary add-row mt-md-0 mt-2">Add
                                        Subcategory</a>
                                         @endadmincan 
                                </div>

                                <div class="card-body order-datatable">
                                <table class="display example_datatable">
                                            <thead>
                                            <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Subcategory</th>
                    <th>Status</th>
                    <th>Cretaed at</th>
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
    var url = "{{route('subcategory_ajax_manage_page') }}";
    var actioncolumn = 5;

   function deleteItem(subcategoryId) {
    var ask = confirm("Are you sure you want to delete?");
    if (ask === true) {
        // Make sure the route is constructed properly with the parameter
        window.location.href = "{{ route('subcategory_delete', ['id' => ':subcategoryId']) }}".replace(':subcategoryId', subcategoryId);
    }
   }
</script>