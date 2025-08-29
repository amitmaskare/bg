@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Transaction List</h3>
                                           
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="#">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Digital</li>
                                    <li class="breadcrumb-item active">Transaction Management</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row product-adding">
                       @if(Session::get('success'))
                       <div class="alert alert-success">
                        {{Session::get('success')}}
                       </div>
                       @endif
                        <div class="col-xl-12">
                            <div class="card">
                            
                                <div class="card-body order-datatable">
                                   <table class="display basic-1">
                                    <thead>
                                        <tr>
                                            <th>Order Id</th>
                                            <th>Transaction</th>
                                            <th>Order Date</th>
                                            <th>Payment Status</th>
                                            <th>Payment Method</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!$data['transaction']->isEmpty())
                                            @foreach($data['transaction'] as $item)
                                                <tr>
                                                    <td>#{{ $item->orderId }}</td>
                                                    <td>#{{ $item->transaction_id }}</td>
                                                  
                                                    <td>{{date('d M Y',strtotime($item->order_date))}}</td>
                                                  <td>{{$item->status}}</td>
                                                  <td>
                                                     @if($item->payment_method=='wallet')
                                                    <span class="badge badge-secondary">Wallet</span>
                                                    @elseif($item->payment_method=='online')
                                                    <span class="badge badge-success">Online</span>
                                                    @else
                                                     <span class="badge badge-info">Cash On Delivery</span>
                                                    @endif
                                                  </td>
                                                  <td>{{$item->total_amount}}</td>
                                                
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <td colspan="6">No Data Found</td>
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
