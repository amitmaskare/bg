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
                     <form method="post" action="{{ route('save_email_template') }}">
                        @csrf
                     
                    <div class="row product-adding">
                        <div class="col-xl-12">
                            <div class="card">
                                
                                <div class="card-body">
                                    <div class="digital-add needs-validation">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Mail Template</label>
                                              <select name="template_id" id="template_id" class="form-control" onchange="getData(this.value)">
                                                <option value="">Select</option>
                                                @if($data['template'])
                                                @foreach($data['template'] as $item)
                                                <option value="{{$item->id}}">{{$item->template_name}}</option>
                                                @endforeach
                                                @endif
                                              </select>
                                            </div>
                                            <div class="col-md-12 mt-3" id="showBody" style="display:none;">

                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                   <center> <button type="submit" class="btn btn-warning">Submit</button></center>
                                </div>
                            </div>
                                                               
                        </div>
                    </div>
                </div>
            </div>
                     
                    </div>

                    </form>
                </div>
                <!-- Container-fluid Ends-->
            </div>
            @endsection

@section('add-js-code')            
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>

    function getData(template_id)
    {
       $.ajax({
        type: 'POST',
        url: "{{ route('getTemplateData') }}",
        data: {
            template_id: template_id,
            _token: "{{ csrf_token() }}",
        },
        dataType:'json',
        success: function(result) {
            $('#showBody').show();
            $('#showBody').html(result.html);
            $('#subject').val(result.subject);
        },
        error: function(xhr) {
            console.log("Error:", xhr.responseText);
        }
     });
    }

   function getTags(tag) {
    if (tag !== "") {
        let textarea = document.getElementById("editor1");

        // Insert at cursor position
        let start = textarea.selectionStart;
        let end = textarea.selectionEnd;
        let text = textarea.value;

        textarea.value = text.substring(0, start) + tag + text.substring(end);

        // Move cursor after inserted tag
        textarea.selectionStart = textarea.selectionEnd = start + tag.length;

        textarea.focus();

        // Reset dropdown
        document.getElementById("tags").value = "";
    }
}




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