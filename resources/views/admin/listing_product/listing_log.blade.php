@extends('layout.admin')
@section('content')

            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Listing Logs</h3>
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
                                   

                                </div>

                                <div class="card-body order-datatable">
                                <table class="display basic-1">
                                            <thead>
                                            <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Created By</th>
                    <th>Action</th>
                    <th>Notes</th>
                    <th>Date</th> 
                  </tr>
                                            </thead>

                                            <tbody>
                    @if($data['logs'])
                  @foreach($data['logs'] as $key=>$value)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{ucwords($value->product_name)}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{ucfirst($value->action)}}</td>
                    <td>{{$value->notes}}</td>
                    <td><p>{{date('d-M-Y H:i A',strtotime($value->created_at))}}</p></td>
                  </tr>
                    @endforeach

                    @else
                    <tr>
                        <td colspan="6"><center>No Data Found</center></td>
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
 
@endsection

<script>
      function deleteProduct(productId) {
           var ask=confirm("Are you sure want to delete ?");
           if(ask==true)
           {
            window.location.href = "{{ url('product/delete') }}" + '/' + productId;

           }
                       
        }
</script>