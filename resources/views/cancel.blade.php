@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-danger">
        Payment was canceled or failed. Please try again.
    </div>
    <a href="{{ route('checkout') }}" class="btn btn-primary">Try Again</a>
</div>
@endsection