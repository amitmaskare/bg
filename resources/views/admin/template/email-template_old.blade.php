@extends('layout.admin')
@section('content')



            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>{{$data['heading']}}</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="javascript:void(0)" >
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Physical</li>
                                    <li class="breadcrumb-item active">{{$data['heading']}}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    @if(Session::get('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Add Cart Mail Template</h4>
                                    <form method="post" action="{{ route('save_email_template') }}">
                                    @csrf
                                    <input type="hidden" name="type" value="add_cart">
                                    
                                    <div class="mb-3">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control" value="{{ $data['add_cart']->subject ?? '' }}" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label>Body</label>
                                        <textarea name="body" class="form-control ckeditor" rows="8">{{ $data['add_cart']->body ?? '' }}</textarea>
                                        <small>Use tags <code>{name}</code>, <code>{product}</code>, <code>{price}</code>, <code>{date_time}</code></small>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </form>


                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->

                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Remove Cart Mail Template</h4>
                                    <form method="post" action="{{ route('save_email_template') }}">
                                    @csrf
                                    <input type="hidden" name="type" value="remove_cart">
                                    
                                    <div class="mb-3">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control" value="{{ $data['remove_cart']->subject ?? '' }}" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label>Body</label>
                                        <textarea name="body" class="form-control ckeditor" rows="8">{{ $data['remove_cart']->body ?? '' }}</textarea>
                                        <small>Use tags <code>{name}</code>, <code>{product}</code>, <code>{price}</code>, <code>{date_time}</code></small>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </form>


                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->

                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Expiring Mail Template</h4>
                                    <form method="post" action="{{ route('save_email_template') }}">
                                    @csrf
                                    <input type="hidden" name="type" value="expiring_soon">
                                    
                                    <div class="mb-3">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control" value="{{ $data['expiring_soon']->subject ?? '' }}" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label>Body</label>
                                        <textarea name="body" class="form-control ckeditor" rows="8">{{ $data['expiring_soon']->body ?? '' }}</textarea>
                                        <small>Use tags <code>{name}</code>, <code>{product}</code>, <code>{bid_amount}</code>, <code>{date_time}</code></small>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </form>


                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->

                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Bid Accept Mail Template</h4>
                                    <form method="post" action="{{ route('save_email_template') }}">
                                    @csrf
                                    <input type="hidden" name="type" value="bid_accept">
                                    
                                    <div class="mb-3">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control" value="{{ $data['bid_accept']->subject ?? '' }}" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label>Body</label>
                                        <textarea name="body" class="form-control ckeditor" rows="8">{{ $data['bid_accept']->body ?? '' }}</textarea>
                                        <small>Use tags <code>{name}</code>, <code>{product}</code>, <code>{bid_amount}</code>, <code>{date_time}</code></small>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </form>


                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->

                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Outbid Mail Template</h4>
                                    <form method="post" action="{{ route('save_email_template') }}">
                                    @csrf
                                    <input type="hidden" name="type" value="outbid">
                                    
                                    <div class="mb-3">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control" value="{{ $data['outbid']->subject ?? '' }}" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label>Body</label>
                                        <textarea name="body" class="form-control ckeditor" rows="8">{{ $data['outbid']->body ?? '' }}</textarea>
                                        <small>Use tags <code>{tag1}</code>, <code>{tag2}</code>, <code>{tag3}</code>, <code>{tag4}</code>, <code>{tag5}</code></small>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </form>


                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->

                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Reject Mail Template</h4>
                                    <form method="post" action="{{ route('save_email_template') }}">
                                    @csrf
                                    <input type="hidden" name="type" value="reject">
                                    
                                    <div class="mb-3">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control" value="{{ $data['reject']->subject ?? '' }}" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label>Body</label>
                                        <textarea name="body" class="form-control ckeditor" rows="8">{{ $data['reject']->body ?? '' }}</textarea>
                                        <small>Use tags <code>{name}</code>, <code>{product}</code>, <code>{bid_amount}</code>, <code>{status}</code>, <code>{date_time}</code></small>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </form>


                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->

                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Counter Mail Template</h4>
                                    <form method="post" action="{{ route('save_email_template') }}">
                                    @csrf
                                    <input type="hidden" name="type" value="counter">
                                    
                                    <div class="mb-3">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control" value="{{ $data['counter']->subject ?? '' }}" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label>Body</label>
                                        <textarea name="body" class="form-control ckeditor" rows="8">{{ $data['counter']->body ?? '' }}</textarea>
                                        <small>Use tags <code>{tag1}</code>, <code>{tag2}</code>, <code>{tag3}</code>, <code>{tag4}</code>, <code>{tag5}</code></small>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </form>


                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->

                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Buy Mail Template</h4>
                                    <form method="post" action="{{ route('save_email_template') }}">
                                    @csrf
                                    <input type="hidden" name="type" value="buy">
                                    
                                    <div class="mb-3">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control" value="{{ $data['buy']->subject ?? '' }}" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label>Body</label>
                                        <textarea name="body" class="form-control ckeditor" rows="8">{{ $data['buy']->body ?? '' }}</textarea>
                                        <small>Use tags <code>{tag1}</code>, <code>{tag2}</code>, <code>{tag3}</code>, <code>{tag4}</code>, <code>{tag5}</code></small>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </form>


                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->

                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Order Mail Template</h4>
                                    <form method="post" action="{{ route('save_email_template') }}">
                                    @csrf
                                    <input type="hidden" name="type" value="order">
                                    
                                    <div class="mb-3">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control" value="{{ $data['order']->subject ?? '' }}" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label>Body</label>
                                        <textarea name="body" class="form-control ckeditor" rows="8">{{ $data['order']->body ?? '' }}</textarea>
                                        <small>Use tags <code>{tag1}</code>, <code>{tag2}</code>, <code>{tag3}</code>, <code>{tag4}</code>, <code>{tag5}</code></small>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </form>


                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->

                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Ship Mail Template</h4>
                                    <form method="post" action="{{ route('save_email_template') }}">
                                    @csrf
                                    <input type="hidden" name="type" value="ship">
                                    
                                    <div class="mb-3">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control" value="{{ $data['ship']->subject ?? '' }}" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label>Body</label>
                                        <textarea name="body" class="form-control ckeditor" rows="8">{{ $data['ship']->body ?? '' }}</textarea>
                                        <small>Use tags <code>{tag1}</code>, <code>{tag2}</code>, <code>{tag3}</code>, <code>{tag4}</code>, <code>{tag5}</code></small>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </form>


                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                        

                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>
            @endsection

@section('add-js-code')            
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    let editors = {}; // store editor instances

    document.querySelectorAll('.ckeditor').forEach(function(editorElement) {
        ClassicEditor
            .create(editorElement, {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'bulletedList', 'numberedList', '|',
                    'link', '|',
                    'undo', 'redo'
                ]
            })
            .then(editor => {
                editors[editorElement.name] = editor;
            })
            .catch(error => {
                console.error(error);
            });
    });

    // Optional JS validation on submit
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function (e) {
            let valid = true;

            for (const name in editors) {
                const data = editors[body].getData().trim();
                if (data === '') {
                    alert(`Body field cannot be empty!`);
                    valid = false;
                    break;
                }
            }

            if (!valid) e.preventDefault();
        });
    });
</script>
@stop