@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>{{$data['heading']?? ''}}</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="javascript:void(0)">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Digital</li>
                                    <li class="breadcrumb-item active">{{$data['heading']?? ''}}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                
                    <form action="{{route('saveTemplate')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row product-adding">
                        <div class="col-xl-12">
                            <div class="card">
                                
                                <div class="card-body">
                                    <div class="digital-add needs-validation">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Template Name</label>
                                            <input type="text" class="form-control" name="template_name" id="template_name" value="{{$data['template']->template_name ?? ''}}">
                                            @error('template_name')
                                             <span class="text-danger">{{$message}}</span> 
                                             @enderror
                                            </div>
                                             <div class="col-md-12 mt-3">
                                           
                                        <div class="">
                                       

                                         <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>    
                                                    <th>Tag Name</th>    
                                          <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="crmTable">
                                                 @if(!empty($data['tags']))
                                        @foreach($data['tags'] as $index=>$value)
                                                        <tr id="row{{ $index + 1 }}">
                                                            <td>{{ $index + 1 }}</td>
                                                             <td><input type="text" class="form-control" name="tags[]" id="tags{{$index+1}}" value="{{$value['tags'] ?? ''}}"></td>
                                                            <td>
                                                                <a href="javascript:void(0)"
                                                                    onclick="appendCurrentCell({{ $index + 1 }});"
                                                                    class="mr-2" title="Add Row">
                                                                    <i class="fa fa-plus"></i>
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                    onclick="deleteCurrentCell({{ $index + 1 }});"
                                                                    title="Delete Row">
                                                                   <i class="fa fa-trash"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr id="row1">
                                                        <td>1</td>
                                    <td><input type="text" class="form-control" name="tags[]" id="tags1" value="" required></td>

                                                        <td>
                                                            <a href="javascript:void(0)" onclick="appendCurrentCell(1);"
                                                                class="mr-2" title="Add Row"><i
                                                                    class="fa fa-plus"></i></a>
                                                            <a href="javascript:void(0)" onclick="deleteCurrentCell(1);"
                                                                title="Delete Row">  <i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-info mr-2"
                                                            onclick="return appendLastCell();">Add</a>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="return deleteLastCell();"
                                                            id="deleteLast">Delete</button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                   
                                        </div>
                                    
                                             
                                            <input type="hidden" name="id" id="id" value="{{$data['template']->id ?? ''}}">
                                          
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                   <button type="submit" class="btn btn-warning">Submit</button>
                                   <a href="{{route('template')}}" class="btn btn-danger" >Cancel</a>
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

<script>
   
    // add row

    function appendCurrentCell(rowId)
  {
    var checkLength=$('#crmTable tr').length;
    var lastRow=checkLength+1;
    if(lastRow>10)
{
    alert('You can only generate a maximum of 10 rows')
    return false;
}
    $('#deleteLast').prop('disabled', false);
    var html='';
    html += `<tr id="row${lastRow}">
                    <td>${lastRow}</td>
                    <td> <input type="text" class="form-control" name="tags[]" id="tags${lastRow}" required></td>
                    <td>
                      <a href="javascript:void(0);" class="mr-2"><i class="fa fa-plus" onclick="appendCurrentCell(${lastRow});"></i></a>
                      <a href="javascript:void(0);" onclick="deleteCurrentCell(${lastRow});">  <i class="fa fa-trash"></i></a>
                    </td>
                  </tr>`;
                  $('#crmTable').append(html);
  }


  function deleteCurrentCell(rowId)
  {
    var checkLength=$('#crmTable tr').length;
    if(checkLength>1)
    {
      $('#deleteLast').prop('disabled', false);
      $('#row'+rowId).remove();
    }
    else{
    $('#deleteLast').prop('disabled', true);
    }
  }
function appendLastCell()
{
    var checkLength=$('#crmTable tr').length;
    var lastRow=checkLength+1;
    $('#deleteLast').prop('disabled', false);
    if(lastRow>10)
{
    sweet_alert('Maximum 10 row generate')
    return false;
}

    var html='';
    html += `<tr id="row${lastRow}">
                    <td>${lastRow}</td>
                    <td> <input type="text" class="form-control" name="tags[]" id="tags${lastRow}" required></td>
                    <td>
                      <a href="javascript:void(0);" class="mr-2"><i class="fa fa-plus" onclick="appendCurrentCell(${lastRow});"></i></a>
                      <a href="javascript:void(0);" onclick="deleteCurrentCell(${lastRow});">  <i class="fa fa-trash"></i></a>
                    </td>
                  </tr>`;
                  $('#crmTable').append(html);

}

function deleteLastCell()
{

  var checkLength=$('#crmTable tr').length;
 if(checkLength>1)
 {
  $('#deleteLast').prop('disabled', false);
  var lastRow=$('#crmTable tr').last();
  if(lastRow.length)
{

  lastRow.remove();
}

 }
 else{
  $('#deleteLast').prop('disabled',true);
 }

}
</script>


