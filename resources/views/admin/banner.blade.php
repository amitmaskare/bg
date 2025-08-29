@extends('layout.admin')
@section('content')

            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Banner List</h3>
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
                                    <li class="breadcrumb-item active">Banner List</li>
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
                                 @admincan('banner-create')
                                    <button type="button" class="btn btn-primary add-row mt-md-0 mt-2 pull-right" data-bs-toggle="modal" data-bs-target="#addBannerModal">Add
                                        Banner</button>
                                         @endadmincan  
                                </div>

                            @if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                            @endif
                                <div class="card-body">
                                    <div class="table-responsive table-desi">
                                        <table class="display example_datatable">
                                            <thead>
                                            <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Cretaed at</th>
                    <th>Action</th>
                  </tr>
                                            </thead>

                <tbody >
                   
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<!-- Container-fluid Ends-->
</div>

{{-- Modal --}}
<div class="modal fade" id="addBannerModal" tabindex="-1" aria-labelledby="addBannerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="bannerForm" enctype="multipart/form-data" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Banner</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="banner_image" class="form-label">Image</label>
            <input type="file" class="form-control" id="banner_image" name="banner_image" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="editBannerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editbannerForm" enctype="multipart/form-data" method="POST">
      
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Banner</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="banner_image" class="form-label">Image</label>
            <input type="file" class="form-control" id="editbanner_image" name="banner_image" required>
            <br>
            <img src="" id="oldImage"  style="width:150px;height:100px;">
          </div>
          <input type="hidden" id="bannerIds"  name="banner_id">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

   var url = "{{route('banner_ajax_manage_page') }}";
    var actioncolumn = 4;

    function getValue(bannerId)
      {
        
        $.ajax({
                    url: "{{ route('banner_getvalue') }}",
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
                window.location.reload(); // Refresh the page to show the new banner
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
               // $('#bannerList').html(response); // Refresh list
                 window.location.reload(); // Refresh the page to show the new banner
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

function deleteBanner(bannerID) {
           var ask=confirm("Are you sure want to delete ?");
           if(ask==true)
           {
            window.location.href = "{{ url('admin/deleteBanner') }}" + '/' + bannerID;

           }
                       
        }
</script>
