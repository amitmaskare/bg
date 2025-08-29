@extends('layout.admin')
@section('content')

            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Blog List
                                       
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="javascript:void(0)" >
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Dashboard</li>
                                    <li class="breadcrumb-item active">Blog List</li>
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
                                @admincan('blog-create')
                                    <a href="{{route('addBlog')}}" class="btn btn-primary add-row mt-md-0 mt-2">Add Blog</a>
                                     @endadmincan
                                </div>

                                <div class="card-body order-datatable table-responsive">
                                    <table class="display example_datatable">
                                            <thead>
                                            <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                                            </thead>

                <tbody id="bannerList">
                 
                        
                    </tbody>
                </table>
            
        </div>
        </div>
    </div>
    </div>
</div>
<!-- Container-fluid Ends-->
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     var url = "{{route('blog_ajax_manage_page') }}";
    var actioncolumn = 5;
    function getValuefor(bannerId)
      {
        
        $.ajax({
                    url: "{{ url('banner_getvalue') }}",
                    type: 'POST',
                    cache:false,
                    data: {
                        bannerId:bannerId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result)
                    {
                     $('#editBannerModal').modal('show');        
                    $("#oldImage").attr('src',result.image);
                    $("#bannerIds").val(result.bannerId);
                    }
                });
      }
</script>
<script>

$(document).ready(function() {
    $('#bannerForm').on('submit', function(e) {

    e.preventDefault();
    let formData = new FormData(this);

        $.ajax({
            url: "{{ route('banners.store') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
              
                $('#addBannerModal').modal('hide');
                $('#bannerForm')[0].reset();
                //$('#bannerList').html(response); // Refresh list
            },
            error: function(err) {
              if (err.status === 422) {
                let errors = err.responseJSON.errors;
                if (errors.banner_image) {
                    alert(errors.banner_image[0]);
                }
            } else {
                alert('Something went wrong!');
            }
            }
        });
});
});

$(document).ready(function() {
    $('#editbannerForm').on('submit', function(e) {

    e.preventDefault();
    let formData = new FormData(this);

        $.ajax({
            url: "{{ route('banners.updateBanner') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
         
                $('#editBannerModal').modal('hide');
                $('#editbannerForm')[0].reset();
                $('#bannerList').html(response); // Refresh list
            },
            error: function(err) {
              if (err.status === 422) {
                let errors = err.responseJSON.errors;
                if (errors.banner_image) {
                    alert(errors.banner_image[0]);
                }
            } else {
                alert('Something went wrong!');
            }
            }
        });
});
});

function deletecategory(bannerID) {
           var ask=confirm("Are you sure want to delete ?");
           if(ask==true)
           {
            window.location.href = "{{ url('deletebBanner') }}" + '/' + bannerID;

           }
                       
        }
</script>
