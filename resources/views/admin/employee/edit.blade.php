@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Edit Blog
                                       
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="javascript:void(0)">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Home</li>
                                    <li class="breadcrumb-item active">Edit Blog</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row product-adding">
                <div class="col-xl-12">
                    <div class="card">
                        
                        <div class="card-body">
                            <div class="digital-add needs-validation">
                            <div class="form-group">
                                <div class="row">
                    <form action="{{ route('blog.update', $blog->blog_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label>Image</label><br>
                                <input type="file" name="image" class="form-control">
                                <br>
                                @if($blog->image)
                                    <img src="{{ asset('uploads/blogs/' . $blog->image) }}" width="100" />
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label>Description</label>
                                <textarea name="description" rows="6" class="form-control" required>{{ old('description', $blog->description) }}</textarea>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </div>
                    </form>
                        </div>
                        <!-- Container-fluid Ends-->
                    </div>
</div>
</div>
</div>
</div>


@endsection



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



