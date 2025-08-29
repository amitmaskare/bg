@extends('layout.admin')
@section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Product Reviews</h3>
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
                        <li class="breadcrumb-item active">Product Reviews</li>
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
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reviews as $index => $review)
                                        <tr>
                                            <td>{{ $reviews->firstItem() + $index }}</td>
                                            <td>{{ $review->user_name }}</td>
                                            <td>{{ $review->product_name }}</td>
                                            <td>
                                                <span class="badge bg-warning text-dark">
                                                    ★ {{ $review->rating }}
                                                </span>
                                            </td>
                                            <td>{{ $review->content }}</td>
                                            <td>{{ \Carbon\Carbon::parse($review->created_at)->format('d M Y, h:i A') }}</td>
                                            <td>
                                                @if ($review->status == 0)
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif ($review->status == 1)
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif ($review->status == 2)
                                                    <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>
                                                  @admincan('review-status')
                                               <select class="form-select form-select-sm change-status" data-id="{{ $review->id }}">
                                                <option value="">Change</option>
                                                <option value="1" {{ $review->status == 1 ? 'selected' : '' }}>Approve</option>
                                                <option value="2" {{ $review->status == 2 ? 'selected' : '' }}>Reject</option>
                                                <option value="0" {{ $review->status == 0 ? 'selected' : '' }}>Pending</option>
                                            </select>
                                             @endadmincan  
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No reviews found.</td>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var url="{{route('review_ajax_manage_page')}}"
     var actioncolumn = 7;
    $(document).ready(function () {
        $('.change-status').on('change', function () {
            let status = $(this).val();
            let reviewId = $(this).data('id');

            if (confirm("Are you sure you want to change the status?")) {
                $.ajax({
                    url: '{{ url("/admin/reviews/status") }}/' + reviewId,
                    type: 'PUT',
                    data: {
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert('✅ ' + response.message);
                        location.reload();
                    },
                    error: function () {
                        alert('❌ Something went wrong.');
                    }
                });
            } else {
                $(this).val(''); // Reset select if cancelled
            }
        });
    });
</script>

@endsection
