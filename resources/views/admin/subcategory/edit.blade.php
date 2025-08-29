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
                                    <h3>Edit Subcategory Field
                                       
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
                                    <li class="breadcrumb-item active">Edit Subcategory Field</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <form action="{{ route('subcategory.update', ['id' => $subcategory->subcategoryId]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                @method('PUT') 
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
                                            @if($categories)
                                            @foreach($categories as $category)
                                        <option value="{{ $category->categoryId }}" {{ ($category->categoryId == $subcategory->categoryId) ? 'selected' : '' }}>
                                            {{ $category->categoryName }}
                                        </option>
                                    @endforeach
                                            @endif
                                           </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label  class="col-form-label pt-0"><span>*</span>
                                               Sub Category</label>
                                          <input type="text" class="form-control" name="name" id="subcategory" list="service-options" value="{{ $subcategory->name ?? '' }}"  required>
                                          <datalist id="service-options">
                                                @if(!$subcategory1->isEmpty())
                                                    @foreach($subcategory1 as $key)
                                                        <option value="{{ $key->name }}"></option>
                                                    @endforeach
                                                @endif
                                                </datalist>
                                        </div>
                                      
                                        <div class="col-md-6">
                                            <label  class="col-form-label pt-0">
                                              Brand Example</label>
                                          <input type="text" class="form-control" name="brand_example" id="brand_example"  value="{{ $subcategory->brand_example ?? '' }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label  class="col-form-label pt-0">
                                               Product Example</label>
                                          <input type="text" class="form-control" name="product_example" id="product_example" value="{{ $subcategory->product_example ?? '' }}" required>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary"  id="addRow">Add</a>
                                        <div class="">
                                        <table class="table table-striped" id="dynamicTable">
                                            <thead>
                                            <tr>
                    <th>#</th>
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
  @if(!empty($additionalFields))
    @foreach($additionalFields as $index => $field)
      <tr class="add-row">
        <td>{{ $index + 1 }}</td>
        <td><input type="text" class="form-control" name="field_name[]" value="{{ $field['field_name'] }}"></td>
        <td>
        <select name="field_type[]" id="field_type1" class="form-control">
                  <option value="input" {{ ($field['field_type'] == 'input') ? 'selected' : '' }}>Input</option>
                  <option value="select" {{ ($field['field_type'] == 'select') ? 'selected' : '' }}>Select</option>
                                            </select>
          <!-- <input type="text" class="form-control" name="field_type[]" value="{{ $field['field_type'] }}"> -->
        </td>
        <td>
          <select name="data_type[]" class="form-control">
            <option value="1" {{ $field['data_type'] == 1 ? 'selected' : '' }}>Alphanumeric</option>
            <option value="2" {{ $field['data_type'] == 2 ? 'selected' : '' }}>Numeric</option>
          </select>
        </td>
        <td>
          <select name="is_required[]" class="form-control">
            <option value="1" {{ $field['is_required'] == 1 ? 'selected' : '' }}>No</option>
            <option value="2" {{ $field['is_required'] == 2 ? 'selected' : '' }}>Yes</option>
          </select>
        </td>
        <td>
          <select name="is_filter[]" class="form-control">
            <option value="1" {{ $field['is_filter'] == 1 ? 'selected' : '' }}>No</option>
            <option value="2" {{ $field['is_filter'] == 2 ? 'selected' : '' }}>Yes</option>
          </select>
        </td>
        <td>
          <input type="text" class="form-control" name="example[]" value="{{ $field['example'] ?? '' }}">
        </td>
        <td><a href="javascript:void(0)" class="deleteRow"><i class="fa fa-trash"></i></a></td>
      </tr>
    @endforeach
  @else

    <tr class="add-row">
      <td>1</td>
      <td><input type="text" class="form-control" name="field_name[]"></td>
      <td><input type="text" class="form-control" name="field_type[]"></td>
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
        <input type="text" class="form-control" name="example">
      </td>
      <td><a href="javascript:void(0)" class="deleteRow"><i class="fa fa-trash"></i></a></td>
    </tr>
  @endif
</tbody>

                                        </table>
                                    </div>
                                        </div>


                                        </div> <!-- row-->

                                        <div class="form-group mt-3 text-center">
                                           <button type="submit" class="btn btn-warning">Submit</button>
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
        <td>${rowCount}</td>
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
         <input type="text" class="form-control" name="example[]"> 
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

