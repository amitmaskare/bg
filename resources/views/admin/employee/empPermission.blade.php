@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>{{$data['heading']?? ''}}</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="javascript:void(0)">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Digital</li>
                                    <li class="breadcrumb-item active">{{$data['heading']?? ''}}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    @if(Session::get('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @elseif(Session::get('error'))
                     <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif
                    <form action="{{route('empgivepermission')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row product-adding">
                        <div class="col-xl-12">
                            <div class="card">
                                
                                <div class="card-body">
                                    <div class="digital-add needs-validation">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">  
                                               <input type="hidden" name="role_id" value="{{ $data['employee']->role_id }}">
                                                <input type="hidden" name="employee_id" value="{{ $data['employee']->id }}">
                                                 <input type="hidden" name="permission_id" id="permission_id" value="{{ isset($data['assigned_permission_ids']) && is_array($data['assigned_permission_ids']) ? implode(',',$data['assigned_permission_ids']) :'' }}">
                                                <label for="name">Employee Name</label>
                                                <input class="form-control" type="text" name="name" value="{{ $data['employee']->name }}" readonly>             
                                            </div>
                                           
                                            <div class="col-md-12">
                                               <div class="card-body order-datatable">
                                <table class="display basic-1">
                                    <thead>
                                        <tr>
                                            <th>Permission Name</th>
                                            <th>Permission</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    @if($data['permission'])
                                    @foreach($data['permission'] as $item)
                                    <tr>
                                        <td>{{ ucfirst($item->name)}}</td>
                                    
                                       <td>
                                            <input type="checkbox" class="permission-checkbox" value="{{ $item->permission_id }}"
                                                {{ in_array($item->permission_id, $data['assigned_permission_ids']) ? 'checked' : '' }}>
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
                                <div class="form-group text-center">
                                   <button type="submit" class="btn btn-warning">Submit</button>
                                </div>
                            </div>
                                                            
                        </div>
                    </div>
                </div>
            </div>
                     
        </div>

        </form>
                </div>
                <!-- Container-fluid Ends-->
            </div>
@endsection


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

  $(document).ready(function() {
        let selectedPermissions = $('#permission_id').val() ? $('#permission_id').val().split(',') : [];
        selectedPermissions.forEach(function(id) {
            $(`.permission-checkbox[value="${id}"]`).prop('checked', true);
        });
        
        updateSelectAllCheckbox();
        
        $('#select_all').change(function() {
            const isChecked = $(this).prop('checked');
            $('.permission-checkbox:visible').prop('checked', isChecked);
            
            $('.permission-checkbox:visible').each(function() {
                const val = $(this).val();
                if(isChecked && !selectedPermissions.includes(val)) {
                    selectedPermissions.push(val);
                } else if(!isChecked) {
                    selectedPermissions = selectedPermissions.filter(item => item !== val);
                }
            });
            
            updatePermissionIds();
        });
        
        $(document).on('change', '.permission-checkbox', function() {
            const val = $(this).val();
            const isChecked = $(this).prop('checked');
            
            if(isChecked && !selectedPermissions.includes(val)) {
                selectedPermissions.push(val);
            } else if(!isChecked) {
                selectedPermissions = selectedPermissions.filter(item => item !== val);
            }
            
            updatePermissionIds();
            updateSelectAllCheckbox();
        });
        
        function updatePermissionIds() {
            $('#permission_id').val(selectedPermissions.join(','));
        }
        
        function updateSelectAllCheckbox() {
            const visibleCheckboxes = $('.permission-checkbox:visible');
            const allChecked = visibleCheckboxes.length > 0 && 
                             visibleCheckboxes.length === visibleCheckboxes.filter(':checked').length;
            $('#select_all').prop('checked', allChecked);
        }
        
        $('form').submit(function() {
            if (selectedPermissions.length < 1) {
                alert('Please select at least one permission');
                return false;
            }
            return true;
        });
        
        
    });
</script>
