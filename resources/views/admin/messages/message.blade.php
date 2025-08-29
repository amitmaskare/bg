@extends('layout.admin')
@section('content')

            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Message List
                                       
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
                                    <li class="breadcrumb-item active">Message List</li>
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
                                                
                                                <th>Product</th>
                                                <th>Message</th>
                                                <th>Reply Messages</th>
                                               
                                                <th>Reply</th>
                                                 <th>Status</th>
                                                <th>Sent At</th>
                                                <th>Action</th>
                                                <th>View Thread</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($messages as $msg)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                 
                                               
                                                    <td>{{ $msg->product->product_name ?? 'N/A' }}</td>
                                                       <td>{{ $msg->message }}</td>
                                                    <td>
                                                     
                                                        @if($msg->reply)
                                                            <div class="mt-2 text-success"><strong>Reply:</strong> {{ $msg->reply }}</div>
                                                         @else
                                                            <em class="text-muted">N/A</em>
                                                            @endif
                                                    </td>
                                                 
                                                    <td>
                                                         @admincan('message-reply')
                                                        @if($msg->status == 1 && Session::get('role') != 'admin')
                                                             <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#replyModal{{ $msg->id }}">
                                                                Reply
                                                            </button>
                                                        @else
                                                            <em class="text-muted">N/A</em>
                                                        @endif
                                                         @endadmincan
                                                    </td>
                                                    <td>
                                                        
                                                        @if($msg->status == 0)
                                                            <span class="badge bg-warning">Pending</span>
                                                        @elseif($msg->status == 1)
                                                            <span class="badge bg-success">Approved</span>
                                                        @elseif($msg->status == 2)
                                                            <span class="badge bg-danger">Rejected</span>
                                                        @endif
                                                    </td>
                                                     <td>{{ $msg->created_at->format('d M Y, h:i A') }}</td>
                                                   <td>
                                                     @admincan('message-status')
                                                        @if($msg->status == 0)
                                                            <select class="form-select form-select-sm change-status" data-id="{{ $msg->id }}">
                                                                <option value="">Change</option>
                                                                <option value="1">Approve</option>
                                                                <option value="2">Reject</option>
                                                            </select>
                                                        @else
                                                            <em class="text-muted">No action</em>
                                                        @endif
                                                         @endadmincan
                                                    </td>
                                                     <td>
                                                         @admincan('message-view')
                                                @if($msg->status == 1)
                                                    <a href="{{ route('admin.thread', $msg->product_id) }}" class="btn btn-info btn-sm">
                                                        View Thread
                                                    </a>
                                                @else
                                                    <em class="text-muted">N/A</em>
                                                @endif
                                                 @endadmincan
                                            </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <tr>
                                                        <td colspan="7" class="text-center">No messages found.</td>
                                                    </tr>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                 

                                    @foreach($messages as $msg)
    @if($msg->status == 1 && Session::get('role') != 'admin')
        <div class="modal fade" id="replyModal{{ $msg->id }}" tabindex="-1" aria-labelledby="replyModalLabel{{ $msg->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.reply', $msg->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="replyModalLabel{{ $msg->id }}">Reply to Message</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <p><strong>User Message:</strong></p>
                            <p class="border p-2">{{ $msg->message }}</p>

                            <div class="mb-3">
                                <label for="reply{{ $msg->id }}" class="form-label">Your Reply:</label>
                                <textarea name="reply" id="reply{{ $msg->id }}" class="form-control" rows="3" required>{{ $msg->reply }}</textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Send Reply</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endforeach
        </div>
        </div>
    </div>
    </div>
</div>
<!-- Container-fluid Ends-->
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $('.change-status').on('change', function () {
        let status = $(this).val();
        let messageId = $(this).data('id');

        if (confirm("Are you sure you want to change the status?")) {
            $.ajax({
                url: '{{ url("/admin/messages/status") }}/' + messageId,
                type: 'PUT',
                data: {
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    alert('✅ Status updated successfully');
                    location.reload();
                },
                error: function (xhr) {
                    let errorMessage = "❌ Something went wrong.";
                    
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage += "\n" + xhr.responseJSON.message;
                    }

                    alert(errorMessage);
                }
            });
        } else {
            $(this).val(''); // reset select if cancelled
        }
    });
});
</script>
