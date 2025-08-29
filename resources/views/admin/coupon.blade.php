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
                                   @admincan('coupon-create')
                                    <button type="button" class="btn btn-primary add-row mt-md-0 mt-2" data-bs-toggle="modal" data-bs-target="#myModal">Add Coupon</button>
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
                    <th>Coupon Code</th>
                    <th>Discount</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                                            </thead>

                                            <tbody>
                    @if(!$data['coupon']->isEmpty())
                  @foreach($data['coupon'] as $key=>$value)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$value['coupon_code']}}</td>
                    <td>{{$value['discount']}}%</td>
                    <td>
                      @if($value['status']=='Active')
                       <span class="badge bg-success">Active<span>
                      @else
                      <span class="badge bg-danger">Inacive<span>
                        @endif
                    </td>
                   
                    <td>
                       @admincan('coupon-edit')
                    <a href="javascript:void(0)" class="btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"  onclick="getValue({{$value['couponId']}})">Edit</a>
                     @endadmincan  
                     @admincan('coupon-delete')
                    <a href="javascript:void(0)" class="btn-danger btn-sm" onclick="deleteCoupon({{$value['couponId']}})">Delete</a>
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
                <!-- Container-fluid Ends-->
            </div>

 <!--  Add modal -->
 <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Coupon</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
        
          <div class="card-body">

           <form action="{{route('saveCoupon')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label>Coupon Code <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="coupon_code" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Discount(%)<span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="discount" autocomplete="off" required>
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
          <h4 class="modal-title">Edit Coupon</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
       
          <div class="card-body">

          <form action="{{route('saveCoupon')}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label>Coupon Code <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="coupon_code" id="coupon_code" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Discount(%)<span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="discount" id="discount" autocomplete="off" required>
              </div>
              <input type="hidden" id="couponId" name="couponId">
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
   function getValue(couponId)
      {
        $.ajax({
                    url: "{{ route('coupon_getvalue') }}",
                    type: 'POST',
                    cache:false,
                    data: {
                         couponId:couponId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result)
                    {
                       
         $("#coupon_code").val(result.coupon_code);
         $("#discount").val(result.discount);
          $("#couponId").val(couponId);
                    }
                });
      }

      function deleteCoupon(couponId) {
           var ask=confirm("Are you sure want to delete ?");
           if(ask==true)
           {
             window.location.href = "/admin/deleteCoupon/" + couponId;

           }
                       
        }
</script>
