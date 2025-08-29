@extends('layout.admin')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>{{ $data['heading'] ?? 'Edit Home Page' }}</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">CMS</li>
                        <li class="breadcrumb-item active">Home Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card tab2-card">
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('admin.cms.home.update', $page->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Page Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $page->title) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Main Heading</label>
                                <input type="text" name="heading" class="form-control" value="{{ old('heading', $page->heading) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Page Content</label>
                                <textarea name="content" class="form-control ckeditor" rows="6">{{ old('content', $page->content) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Image 1</label>
                                    <input type="file" class="form-control" name="home_image1" accept="image/*">
                                    @if($page->home_image1)
                                        <img src="{{ asset('uploads/cms/' . $page->home_image1) }}" width="120" class="mt-2" alt="Image 1">
                                    @endif
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Image 2</label>
                                    <input type="file" class="form-control" name="home_image2" accept="image/*">
                                    @if($page->home_image2)
                                        <img src="{{ asset('uploads/cms/' . $page->home_image2) }}" width="120" class="mt-2" alt="Image 2">
                                    @endif
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Image 3</label>
                                    <input type="file" class="form-control" name="home_image3" accept="image/*">
                                    @if($page->home_image3)
                                        <img src="{{ asset('uploads/cms/' . $page->home_image3) }}" width="120" class="mt-2" alt="Image 3">
                                    @endif
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info btn-sm">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CKEditor Script -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    document.querySelectorAll('.ckeditor').forEach((el) => {
        ClassicEditor
            .create(el)
            .catch(error => console.error(error));
    });
</script>
@endsection
