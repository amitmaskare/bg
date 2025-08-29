@extends('layout.admin')
@section('content')



            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Measure
                                       
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
                                    <li class="breadcrumb-item active">Measure</li>
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
                                  
                                    @admincan('weight-create')
                                    <button type="button" class="btn btn-primary add-row mt-md-0 mt-2" data-bs-toggle="modal" data-bs-target="#myModal">Add
                                    Measure</button>
                                     @endadmincan 
                                </div>

                                <div class="card-body order-datatable">
                                <table class="display basic-1">
                                            <thead>
                                            <tr>
                    <th>#</th>
                    <th>Measure</th>
                    <th>Status</th>
                    <th>Cretaed at</th>
                    <th>Action</th>
                  </tr>
                                            </thead>

                                            <tbody>
                    @if($data['weight'])
                  @foreach($data['weight'] as $key=>$value)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$value['weight']}}</td>
                    <td>
                      @if($value['status']=='Active')
                       <span class="badge bg-success">Active<span>
                      @else
                      <span class="badge bg-danger">Inacive<span>
                        @endif
                    </td>
                    <td>{{$value['created_at']}}</td>
                    <td>
                       @admincan('weight-edit')
                    <a href="javascript:void(0)" class="btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"  onclick="getValue({{$value['weightId']}})">Edit</a>
                     @endadmincan 
                    @admincan('weight-delete')
                    <a href="javascript:void(0)" class="btn-danger btn-sm" onclick="deleteDesignation({{$value['weightId']}})">Delete</a>
                   @endadmincan   
                  </td>
                  </tr>
                    @endforeach
                    @endif 

                                              
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
          <h4 class="modal-title">Add Weight</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
        
          <div class="card-body">

           <form action="{{route('saveWeight')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label>Measure<span style="color:red;">*</span> <span id="category_err"></span></label>
                <input class="form-control" type="text" name="weight" id="weight" autocomplete="off" required>
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
          <h4 class="modal-title">Edit Weight</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
       
          <div class="card-body">

          <form action="{{route('weight_update')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label>Measure <span style="color:red;">*</span> <span id="category_err"></span></label>
                <input class="form-control" type="text" name="weight" id="edit_name" autocomplete="off" required>
              </div>
              <input type="hidden" id="weightId" name="weightId">
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
   function getValue(weightId)
      {
        $.ajax({
                    url: "{{ url('admin/weight_getvalue') }}",
                    type: 'POST',
                    cache:false,
                    data: {
                         weightId:weightId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result)
                    {
                       
         $("#edit_name").val(result.name);
          $("#weightId").val(result.id);
                    }
                });
      }

      function deleteDesignation(weightId) {
           var ask=confirm("Are you sure want to delete ?");
           if(ask==true)
           {
            window.location.href = "{{ url('admin/weight_delete') }}" + '/' + weightId;

           }
                       
        }
</script>