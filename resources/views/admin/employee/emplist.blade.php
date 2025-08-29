@extends('layout.admin')
@section('content')

            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Employee List
                                       
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
                                    <li class="breadcrumb-item">Dashboard</li>
                                    <li class="breadcrumb-item active">Employee List</li>
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
                                  @admincan('employee-create')
                                    <a href="{{route('employee.create')}}" class="btn btn-primary add-row mt-md-0 mt-2">Add Employee</a>
                                @endadmincan
                                </div>

                                <div class="card-body order-datatable">
                                    <table class="display basic-1">
                                            <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Image</th>
                                         
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                            </thead>

                <tbody id="bannerList">
                    @if($employee)
                  @foreach($employee as $key=>$value)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$value['name']}}</td>
                    <td>{{$value['email']}}</td>
                    <td>{{ $value['role_name'] }}</td>
                    <td>
                        @if($value['profile'] && file_exists(public_path('uploads/employee/'.$value['profile'])))
                        <img src="{{asset('uploads/employee/'.$value['profile'])}}" alt="" width="70px" height="70px">
                        @else
                        <img src="{{asset('assets/images/product-details/product/1.jpg')}}" alt="" width="70px" height="70px">
                        @endif
                    </td>
               
                    <td>{{$value['created_at']}}</td>
                    <td>
                    @admincan('employee-permission')
                    <a  class="btn-primary btn-sm me-2" href="{{ route('employee.empPermission', $value['id']) }}">Permission </a>
                    @endadmincan
                     @admincan('employee-permission')
                    <a  class="btn-info btn-sm me-2" href="javascript:void(0)" data-bs-toggle="modal" style="white-space: nowrap;" data-bs-target="#editModal"
                    onclick="changeRole({{ $value->id }}, '{{ $value->role_id }}')"> Change Role </a>
                    @endadmincan
                     @admincan('employee-edit')
                    <a  class="btn-success btn-sm me-2" href="{{ route('employee.edit', $value['id']) }}"> Edit </a>
                    @endadmincan
                    @admincan('employee-delete')    
                    <a href="javascript:void(0)" class="btn-danger btn-sm"  onclick="deleteEmployee({{$value->id}})">Delete</a> 
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

<!--  edit mmodal -->
   <div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Change Status</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
       
          <div class="card-body">

          <form action="{{ route('updateRole') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Role <span style="color:red;">*</span></label>
                <select name="role_id" id="role_id" class="form-control" required>
                    <option value="">Select Role</option>
                    @foreach($roless as $role)
                        <option value="{{ $role->role_id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" id="employee_id" name="employee_id">
            <div class="mt-4">
                <button class="btn btn-sm btn-primary" type="submit">Update</button>
                <a href="#" class="btn btn-link" data-bs-dismiss="modal">Cancel</a>
            </div>
        </form>

          </div>
     
        </div>
      
      </div>
    </div>
  </div>
  <!--  end edit modal -->

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

function deleteEmployee(id) {
           var ask=confirm("Are you sure want to delete ?");
           if(ask==true)
           {
            window.location.href = "{{ url('admin/employee/delete') }}/" + id;

           }
                       
        }
</script>

<script>
    function changeRole(employeeId, roleId) {
        document.getElementById('employee_id').value = employeeId;
        document.getElementById('role_id').value = roleId;
    }
</script>
