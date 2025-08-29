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
                                    <form class="form-inline search-form search-box">
                                        <div class="form-group">
                                            <input class="form-control-plaintext" type="search" placeholder="Search..">
                                        </div>
                                    </form>
                                     @admincan('currency-create')
                                    <button type="button" class="btn btn-primary add-row mt-md-0 mt-2" data-bs-toggle="modal" data-bs-target="#myModal">Add
                                        Currency</button>
                                         @endadmincan 
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive table-desi">
                                        <table class="table all-package table-category " id="editableTable">
                                            <thead>
                                            <tr>
                    <th>#</th>
                    <th>Currency Name</th>
                    <th>Status</th>
                    <th>Cretaed at</th>
                    <th>Action</th>
                  </tr>
                                            </thead>

                                            <tbody>
                    @if(!$data['currency']->isEmpty())
                  @foreach($data['currency'] as $key=>$value)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$value['currency_name']}}</td>
                    <td>
                      @if($value['status']=='Active')
                       <span class="badge bg-success">Active<span>
                      @else
                      <span class="badge bg-danger">Inacive<span>
                        @endif
                    </td>
                    <td>{{$value['created_at']}}</td>
                    <td>
                       @admincan('currency-edit')
                    <a href="javascript:void(0)" class="btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"  onclick="getValue({{$value['id']}})">Edit</a>
                     @endadmincan 
                    @admincan('currency-delete')
                    <a href="javascript:void(0)" class="btn-danger btn-sm" onclick="deleteCurrency({{$value['id']}})">Delete</a>
                   @endadmincan 
                  </td>
                  </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">No Data Found</td>
                    </tr>
                    @endif 

                                              
                                            </tbody>
                                        </table>
                                    </div>
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
          <h4 class="modal-title">Add Currency</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
        
          <div class="card-body">

           <form action="{{route('saveCurrency')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label>Currency Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="currency_name" autocomplete="off" required>
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
          <h4 class="modal-title">Edit Currency</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
       
          <div class="card-body">

          <form action="{{route('updateCurrency')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label>Currency Name <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="currency_name" id="currency_name" autocomplete="off" required>
              </div>
              <input type="hidden" id="id" name="id">
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
   function getValue(id)
      {
        $.ajax({
                    url: "{{ url('currency_getvalue') }}",
                    type: 'POST',
                    cache:false,
                    data: {
                         id:id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result)
                    {
                       
         $("#currency_name").val(result.currency_name);
          $("#id").val(id);
                    }
                });
      }

      function deleteCurrency(id) {
           var ask=confirm("Are you sure want to delete ?");
           if(ask==true)
           {
            window.location.href = "{{ url('deleteCurrency') }}" + '/' + id;

           }
                       
        }
</script>
