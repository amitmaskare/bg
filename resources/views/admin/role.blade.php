@extends('layout.admin')
@section('content')



            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>{{$data['heading']}}</h3>
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
                                    @admincan('role-create')
                                    <button type="button" class="btn btn-primary add-row mt-md-0 mt-2" data-bs-toggle="modal" data-bs-target="#myModal">Add
                                    Role</button>
                                    @endadmincan
                                </div>
                            @if(Session::get('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif

                                <div class="card-body order-datatable">
                                <table class="display basic-1">
                                            <thead>
                                            <tr>
                    <th>#</th>
                    <th>Role Name</th>
                    <th>Status</th>
                    <th>Cretaed at</th>
                    <th>Action</th>
                  </tr>
                                            </thead>

                                            <tbody>
                    @if($data['role'])
                  @foreach($data['role'] as $key=>$value)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{ ucfirst($value['name'])}}</td>
                    <td>
                      @if($value['status']=='Active')
                       <span class="badge bg-success">Active<span>
                      @else
                      <span class="badge bg-danger">Inacive<span>
                        @endif
                    </td>
                    <td>{{$value['created_at']}}</td>
                    <td>
                       @admincan('role-update')
                      <a href="javascript:void(0)" class="btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"  onclick="getValue({{$value['role_id']}})">Edit</a>
                      @endadmincan
                       @admincan('role-delete')
                      <a href="javascript:void(0)" class="btn-danger btn-sm" onclick="deleteRole({{$value['role_id']}})">Delete</a>
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
          <h4 class="modal-title">Add Role</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
        
          <div class="card-body">

           <form action="{{route('saverole')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label>Role Name <span style="color:red;">*</span> <span id="role_err"></span></label>
                <input class="form-control" type="text" name="name" id="name" autocomplete="off" required>
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
          <h4 class="modal-title">Edit Role</h4>
         <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
       
          <div class="card-body">

          <form action="{{route('saverole')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label>Role Name <span style="color:red;">*</span> <span id="editrole_err"></span></label>
                <input class="form-control" type="text" name="name" id="edit_name" autocomplete="off" required>
              </div>
              <input type="hidden" id="role_id" name="role_id">
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
   function getValue(role_id)
      {
        $.ajax({
                    url: "{{ route('role_getvalue') }}",
                    type: 'POST',
                    cache:false,
                    data: {
                         role_id:role_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result)
                    {
                       
         $("#edit_name").val(result.name);
          $("#role_id").val(result.id);
                    }
                });
      }

      function deleteRole(role_id) {
           var ask=confirm("Are you sure want to delete ?");
           if(ask==true)
           {
            window.location.href = "{{ url('admin/role_delete') }}" + '/' + role_id;
            

           }
                       
        }
</script>


