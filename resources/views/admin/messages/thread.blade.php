@extends('layout.admin')
@section('content')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Message Thread – {{ $product->product_name ?? 'N/A' }}</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.messages') }}">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active">Thread</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages Display -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Conversation</h5>
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="card-body" style="max-height: 400px; overflow-y: auto; background-color: #f9f9f9;">
                        @forelse($messages as $msg)
                            <div class="d-flex mb-4 {{ $msg->sender_type === 'seller' ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="chat-box p-3 rounded shadow-sm" style="max-width: 70%; background-color: {{ $msg->sender_type === 'seller' ? '#e9f7ef' : '#eef1f7' }}">
                                    <div class="small text-muted mb-1">
                                        <strong>{{ ucfirst($msg->sender_type) }}</strong> • {{ $msg->created_at->format('d M Y, h:i A') }}
                                    </div>
                                    <div>{{ $msg->message }}</div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">No approved messages yet for this thread.</p>
                        @endforelse
                    </div>

                    <!-- Reply Form -->
                    <div class="card-footer">
                        <form action="{{ route('admin.messages.send') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="user_id" value="{{ $messages->first()->user_id ?? '' }}">
                            <input type="hidden" name="seller_id" value="{{ $messages->first()->seller_id ?? '' }}">

                            <div class="row g-3 align-items-center">
                                <div class="col-md-10">
                                    <textarea name="message" class="form-control" placeholder="Type your message here..." rows="2" required></textarea>
                                </div>
                                <div class="col-md-2 d-grid">
                                    <button type="submit" class="btn btn-success btn-block">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.change-status').forEach(select => {
        select.addEventListener('change', function() {
            let status = this.value;
            let id = this.dataset.id;
            if (!status) return;

            if (confirm("Confirm status change?")) {
                fetch(`/admin/messages/status/${id}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ status })
                })
                .then(res => res.json())
                .then(data => {
                    alert("Status updated.");
                    window.location.reload();
                })
                .catch(err => {
                    alert("Error updating status.");
                });
            }
        });
    });
});
</script>
@endsection
