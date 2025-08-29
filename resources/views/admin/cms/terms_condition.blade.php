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

                                    <form method="POST" action="{{ route('admin.cms.update', $page->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3 mt-4">
                                            <label class="form-label"><strong>{{ $page->title }}</strong></label>
                                            <textarea name="content" rows="10" class="form-control" required>{{ old('content', $page->content) }}</textarea>
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
@endsection
