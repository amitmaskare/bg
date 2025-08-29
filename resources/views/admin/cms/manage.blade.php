@extends('layout.admin')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>{{ $data['heading'] ?? 'CMS Pages' }}</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active">{{ $data['heading'] ?? 'CMS Pages' }}</li>
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
                        <ul class="nav nav-tabs nav-material" id="cmsTab" role="tablist">
                            @foreach($data['pages'] as $key => $page)
                                <li class="nav-item">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                                        id="tab-{{ $key }}-tab" data-bs-toggle="tab"
                                        href="#tab-{{ $key }}" role="tab"
                                        aria-controls="tab-{{ $key }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        <i data-feather="file-text" class="me-2"></i>{{ $page->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="cmsTabContent">
                            @foreach($data['pages'] as $key => $page)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                     id="tab-{{ $key }}" role="tabpanel"
                                     aria-labelledby="tab-{{ $key }}-tab">

                                   <form method="POST" action="{{ route('admin.cms.update', $page->id) }}?tab=tab-{{ $key }}" enctype="multipart/form-data">

                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3 mt-4">
                                            <label class="form-label">Page Title</label>
                                            <input type="text" name="title" class="form-control" value="{{ old('title', $page->title) }}">
                                        </div>

                                        @if($page->slug == 'about')
                                            <div class="mb-3">
                                                <label class="form-label">Sub Title</label>
                                                <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $page->subtitle) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Mission</label>
                                                <textarea name="mission" class="form-control ckeditor">{{ old('mission', $page->mission) }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Vision</label>
                                                <textarea name="vision" class="form-control ckeditor">{{ old('vision', $page->vision) }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                            <label for="image">Upload Image:</label>
                                            <input type="file" class="form-control" name="image" accept="image/*">
                                            @if($page->image)
                                                <img src="{{ asset('uploads/cms/' . $page->image) }}" width="120" class="mt-2" alt="CMS Image">
                                            @endif
                                        </div>
                                        @endif

                                        <div class="mb-3">
                                            <label class="form-label">Page Content</label>
                                            <textarea name="content" class="form-control ckeditor" rows="10" required>{{ old('content', $page->content) }}</textarea>
                                        </div>
                                        
                                        

                                        <button type="submit" class="btn btn-sm btn-info">Update</button>
                                    </form>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    document.querySelectorAll('.ckeditor').forEach((el) => {
        ClassicEditor
            .create(el)
            .catch(error => {
                console.error(error);
            });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const activeTab = "{{ session('activeTab') }}";
        if (activeTab) {
            const triggerEl = document.querySelector(`a[href="#${activeTab}"]`);
            if (triggerEl) {
                const tab = new bootstrap.Tab(triggerEl);
                tab.show();
            }
        }
    });
</script>
@endsection