@extends('layout.admin')
@section('content')

            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>{{$data['heading']}}
                                        
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
                                    <li class="breadcrumb-item active">{{$data['heading']}}</li>
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
                                   
                                 @admincan('brand-create')
                                    <button type="button" class="btn btn-primary add-row mt-md-0 mt-2" data-bs-toggle="modal" data-bs-target="#myModal">Add
                                        Brand</button>
                                         @endadmincan  
                                </div>

                                <div class="card-body order-datatable">
                                <table class="example_datatable">
                                            <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Brand Name</th>
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

 <!--  Add modal -->
 <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Brand</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
        
          <div class="card-body">

           <form action="{{route('saveBrand')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label>Brand Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="brand_name" autocomplete="off" required>
              </div>
             
              <div class="mt-4">
                <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                <a href="#" class="btn  btn-link" data-bs-dismiss="modal">Cancel</a>
              </div>
            </form>

          </div>
       
        </div>
       
      </div>
    </div>
  </div>
  <!--  end add modal -->

   <!--  edit mmodal -->
   <div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Brand</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
       
          <div class="card-body">

          <form action="{{route('updateBrand')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label>Brand Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="brand_name" id="brand_name" autocomplete="off" required>
              </div>
              <input type="hidden" id="brandId" name="brandId">
              <div class="mt-4">
                <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                <a href="#" class="btn  btn-link" data-bs-dismiss="modal">Cancel</a>
              </div>
            </form>

          </div>
     
        </div>
      
      </div>
    </div>
  </div>
  <!--  end edit modal -->

@endsection

<script>
      var url = "{{route('brand_ajax_manage_page') }}";
    var actioncolumn = 4;
   function getValue(brandId)
      {
        $.ajax({
                    url: "{{ url('admin/brand_getvalue') }}",
                    type: 'POST',
                    cache:false,
                    data: {
                         brandId:brandId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result)
                    {
                  $("#editModal").modal('show');     
         $("#brand_name").val(result.brand_name);
          $("#brandId").val(brandId);
                    }
                });
      }

      function deleteBrand(brandId) {
           var ask=confirm("Are you sure want to delete ?");
           if(ask==true)
           {
            window.location.href = "{{ url('admin/deleteBrand') }}" + '/' + brandId;

           }
                       
        }
</script>
