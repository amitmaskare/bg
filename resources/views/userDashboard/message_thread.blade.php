@extends('layout.app')
@section('content')

<style>
    .chat-container {
        max-height: 400px;
        overflow-y: auto;
        padding: 20px;
        border: 1px solid #eee;
        background-color: #f9f9f9;
        border-radius: 10px;
    }

    .chat-bubble {
        margin-bottom: 15px;
        padding: 12px 15px;
        border-radius: 15px;
        max-width: 70%;
        clear: both;
    }

    .chat-left {
        background-color: #e4f0ff;
        float: left;
        text-align: left;
    }

    .chat-right {
        background-color: #d1ffd6;
        float: right;
        text-align: right;
    }

    .chat-meta {
        font-size: 0.8rem;
        color: #666;
        margin-top: 4px;
    }

    .send-box {
        margin-top: 20px;
    }

    .send-box textarea {
        resize: none;
    }

</style>

<!-- Breadcrumb -->
<div class="breadcrumb-section">
    <div class="container">
        <h2>Message Thread</h2>
        <nav class="theme-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('messageList') }}">Messages</a></li>
                <li class="breadcrumb-item active">Thread</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Message Thread -->
<section class="dashboard-section section-b-space user-dashboard-section">
    <div class="container">
        <div class="row">

            @include('userDashboard.sidebar')

            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h5>Conversation - {{ $product->product_name ?? 'N/A' }}</h5>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="chat-container">
                            @forelse($messages as $msg)
                                <div class="chat-bubble {{ $msg->sender_type == 'user' ? 'chat-right' : 'chat-left' }}">
                                    <strong>{{ $msg->sender->name ?? 'Unknown' }}</strong><br>
                                    {{ $msg->message }}
                                    <div class="chat-meta">
                                        {{ $msg->created_at->format('d M Y, h:i A') }}
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-muted">No conversation yet.</p>
                            @endforelse
                            <div style="clear: both;"></div>
                        </div>

                        <!-- Send Message Form -->
                        <div class="send-box mt-4">
                            <form action="{{ route('user.messages.send') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="mb-3">
                                    <textarea name="message" rows="3" class="form-control" placeholder="Type your message..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </form>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('messageList') }}" class="btn btn-outline-secondary">Back to Messages</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
