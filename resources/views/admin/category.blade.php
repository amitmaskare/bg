@extends('layout.admin')
@section('content')

            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Category
                                       
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
                                <div class="card-header">
                               @admincan('category-create')       
                           <button type="button" class="btn btn-primary add-row mt-md-0 mt-2" data-bs-toggle="modal" data-bs-target="#myModal">Add
                                        Category</button>
                                </div>
                                @endadmincan
                              @if(session('success'))
                              <div class=" alert alert-success">{{session('success')}}</div>
                              @endif
                                <div class="card-body order-datatable">
                                <table class="display example_datatable">
                                            <thead>
                                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Category Name</th>
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
          <h4 class="modal-title">Add Category</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
        
          <div class="card-body">

           <form action="{{route('saveCategory')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label>Category Name <span style="color:red;">*</span> <span id="category_err"></span></label>
                <input class="form-control" type="text" name="categoryName" id="categoryName" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Image<span style="color:red;">*</span></label>
                <input class="form-control" type="file" name="image" autocomplete="off" required>
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
          <h4 class="modal-title">Edit Category</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
       
          <div class="card-body">

          <form action="{{route('saveCategory')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label>Category Name <span style="color:red;">*</span> <span id="category_err"></span></label>
                <input class="form-control" type="text" name="categoryName" id="edit_name" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Image<span style="color:red;">*</span></label>
                <input class="form-control" type="file" name="image" autocomplete="off">
              </div>
              <div class="form-group" id="showImg">
                </div>
                <input type="hidden" id="old_image" name="old_image">
                <input type="hidden" id="categoryId" name="categoryId">
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
    var url = "{{route('category_ajax_manage_page') }}";
    var actioncolumn = 5;

   function getValue(categoryId)
      {
        $.ajax({
                    url: "{{ route('category_getvalue') }}",
                    type: 'POST',
                    cache:false,
                    data: {
                         categoryId:categoryId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result)
                    {
                       
         $("#edit_name").val(result.name);
         $("#categoryId").val(result.id);
         $("#old_image").val(result.old_image);
         $("#showImg").html(result.img);
                    }
                });
      }

      function deletecategory(categoryId) {
           var ask=confirm("Are you sure want to delete ?");
           if(ask==true)
           {
            window.location.href = "{{ url('admin/category_delete') }}" + '/' + categoryId;

           }
                       
        }
</script>
