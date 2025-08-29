@extends('layout.admin')
@section('content')


<style>
    .table th {
  color: #313131;
  font-weight: 600;
  font-size: 14px !important;
}
</style>
<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Add Subcategory Field
                                       
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
                                    <li class="breadcrumb-item">Digital</li>
                                    <li class="breadcrumb-item active">Add Subcategory Field</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <form action="{{route('saveSubcategory')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row product-adding">
                        <div class="col-xl-12">
                            <div class="card">
                               
                                <div class="card-body">
                                    <div class="digital-add needs-validation">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                Category</label>
                                           <select name="categoryId" id="" class="form-control" onchange="getSubcategoryValue(this.value)">
                                            <option value="">Select</option>
                                            @if($data['category'])
                                            @foreach($data['category'] as $key)
                                            <option value="{{$key->categoryId}}">{{$key->categoryName}}</option>
                                            @endforeach
                                            @endif
                                           </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label  class="col-form-label pt-0"><span>*</span>
                                               Sub Category</label>
                                          <input type="text" class="form-control" name="name" id="subcategory" list="service-options" required>
                                         
                                                <datalist id="service-options">
                                                @if($data['subcategory'])
                                                    @foreach($data['subcategory'] as $key)
                                                        <option value="{{ $key->name }}"></option>
                                                    @endforeach
                                                @endif
                                                </datalist>
                                        </div>
                                        
                                        <div class="col-md-6 mt-3">
                                            <label  class="col-form-label pt-0">
                                              Brand Example</label>
                                          <input type="text" class="form-control" name="brand_example" id="brand_example" required>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label  class="col-form-label pt-0">
                                               Product Example</label>
                                          <input type="text" class="form-control" name="product_example" id="product_example" required>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                           
                                        <div class="">
                                        <table class="table table-striped" id="dynamicTable">
                                            <thead>
                                            <tr>
                    <th>Field Name</th>
                    <th>Field Type(input/select)</th>
                    <th>DataType</th>
                    <th>Is Required </th>
                    <th>Is Filter </th>
                    <th>Example </th>
                    <th>Action</th>
                  </tr>
                                            </thead>

                                            <tbody id="clonetable_feedback1">
                                            <tr class="add-row">
                                                <!-- <td>1</td> -->
                                            <td><input type="text" class="form-control" name="field_name[]" id="field_name1"></td>
                                            <td>
                                            <select name="field_type[]" id="field_type1" class="form-control">
                                                <option value="input">Input</option>
                                                <option value="select">Select</option>
                                            </select>
                                              <!-- <input type="text" class="form-control" name="field_type[]" id="field_type1"> -->
                                            </td>
                                            <td>
                                                <select name="data_type[]" id="data_type1" class="form-control">
                                                <option value="1">Alphanumeric</option>
                                                <option value="2">Numeric</option>
                                            </select>
                                        </td>
                                            <td>
                                            <select name="is_required[]" id="is_required1" class="form-control">
                                                <option value="1">No</option>
                                                <option value="2">Yes</option>
                                            </select>
                                            </td>
                                            <td>
                                            <select name="is_filter[]" id="is_filter1" class="form-control">
                                                <option value="1">No</option>
                                                <option value="2">Yes</option>
                                            </select>
                                            </td>
                                          
                                            <td>
                                              <input type="text" class="form-control" name="example[]" id="example1"> 
                                            </td>
                                            <td>
                                              
                                              <a href=javascript:void(0)" class="deleteRow"><i class="fa fa-trash"></i></a>
                                            </td>
                                            </tr>

                                              
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary mt-3 "  id="addRow">Add</a>
                                        </div>
                                       

                                        </div> <!-- row-->

                                        <div class="form-group mt-3 text-center">
                                           <button type="submit" class="btn btn-warning">Submit</button>
                                           <a href="{{route('subcategory')}}" class="btn btn-danger">Cancel</a>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
  let rowCount = 1;

  $('#addRow').click(function() {
    rowCount++;
    let newRow = `
      <tr class="add-row">
      
        <td><input type="text" class="form-control" name="field_name[]" ></td>
        <td>
         <select name="field_type[]" id="field_type1" class="form-control">
                                                <option value="input">Input</option>
                                                <option value="select">Select</option>
                                            </select>
        </td>
        <td>
          <select name="data_type[]" class="form-control">
            <option value="1">Alphanumeric</option>
            <option value="2">Numeric</option>
          </select>
        </td>
        <td>
          <select name="is_required[]" class="form-control">
            <option value="1">No</option>
            <option value="2">Yes</option>
          </select>
        </td>
        <td>
          <select name="is_filter[]" class="form-control">
            <option value="1">No</option>
            <option value="2">Yes</option>
          </select>
        </td>
         <td>
         <input type="text" class="form-control" name="example[]" id="example${rowCount}"> 
        </td>
        <td><a href="javascript:void(0)" class="deleteRow"><i class="fa fa-trash"></i></a></td>
      </tr>`;
    $('#dynamicTable tbody').append(newRow);
  });

  // Delete row
  $(document).on('click', '.deleteRow', function() {
    $(this).closest('tr').remove();
    // Optional: re-index the row numbers
    $('#dynamicTable tbody tr').each(function(index) {
      $(this).find('td:first').text(index + 1);
    });
    rowCount = $('#dynamicTable tbody tr').length;
  });
});
</script>

