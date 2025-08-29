@extends('layout.admin')
@section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Conatcts</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active">Conatcts</li>
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
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>

                    <div class="card-body order-datatable">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contact_messages as $index => $contact_messages)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{ $contact_messages->full_name }}</td>
                                            <td>{{ $contact_messages->email }}</td>
                                            <td>
                                                <span class="badge bg-warning text-dark">
                                                    {{ $contact_messages->phone }}
                                                </span>
                                            </td>
                                              <td>{{ $contact_messages->subject }}</td>
                                            <td>{{ $contact_messages->message }}</td>
                                            <td>{{ \Carbon\Carbon::parse($contact_messages->created_at)->format('d M Y, h:i A') }}</td>
                                           @admincan('contact_messages-delete')
                                           <td>
                                            <a href="javascript:void(0)" class="btn-danger btn-sm" onclick="deletecategory({{$contact_messages->id}})">Delete</a>
                                            @endadmincan 
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Message not found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end mt-3">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Container-fluid Ends-->
</div>

<script>

 function deletecategory(msgId) {
           var ask=confirm("Are you sure want to delete ?");
           if(ask==true)
           {
            window.location.href = "{{ url('admin/message_deletes') }}" + '/' + msgId;

           }
                       
        }
</script>
@endsection
