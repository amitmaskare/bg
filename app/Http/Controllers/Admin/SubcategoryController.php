<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validation;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use DB;
class SubcategoryController extends Controller
{
   
        public function index()
        {
         $data['title']='Subcategory';
         $data['page']='subcategory';
          return view('admin.subcategory',compact('data'));  
        }

        public function ajax_manage_page(Request $request)
    {
         $Subcategory = new Subcategory();
        $getData = $Subcategory->getDatatables($request);
        $start = $request->input('start', 0);
        $draw = $request->input('draw', 1);
        $data = [];
        $no = $start;
        foreach ($getData as $item) {
          $btn='';
         
            $btn .= '<a href="'.route('subcategory.edit',["id"=>$item->subcategoryId]).'" class="btn-success btn-sm me-2">Edit</a>';
          
            $btn .= '<a href="javascript:void(0)" class="btn-danger btn-sm" onclick="deleteItem('.$item->subcategoryId.')">Delete</a>';
             
            $status=$item->status=='Active' ? '<span class="badge bg-success">Active<span>':'<span class="badge bg-danger">Inactive<span>';
                      
            $no++;
            $nestedData = [];
            $nestedData[] = $no;
            $nestedData[] = ucfirst($item->categoryName);
            $nestedData[] = ucfirst($item->name);
            $nestedData[] = $status;
            $nestedData[] = date('d-M-Y H:i A',strtotime($item->created_at));
            $nestedData[] = $btn;
            $data[] = $nestedData;
        }

        $output = [
            "draw" => $draw,
            "recordsTotal" => $Subcategory->countAll(),
            "recordsFiltered" => $Subcategory->countFiltered($request),
            "data" => $data,
        ];

        return response()->json($output);
    }

          function addsubcategory()
          {
            $data['category']=Category::all();
            $data['subcategory']=Subcategory::all();
            return view('admin.subcategory.add',compact('data')); 
          }
    
        public function saveSubcategory(Request $request)
        { 
         
          $fields = [];
          $count = count($request['field_name']);
        
          for ($i=0; $i < $count; $i++)
         {
                 $fields[] =[
                  'field_name' => str_replace(' ','_',$request['field_name'])[$i],
                    //'field_name'=>$request['field_name'][$i],
                    'field_type'=>$request['field_type'][$i],
                    'data_type'=>$request['data_type'][$i],
                    'is_required'=>$request['is_required'][$i],
                    'is_filter'=>$request['is_filter'][$i],
                    'example'=>$request['example'][$i],
                 ];
              
          }
            $subcategory=new Subcategory();
           
            $subcategory->categoryId=$request->categoryId;
            $subcategory->name =$request->name;
            $subcategory->brand_example = $request->brand_example;
            $subcategory->product_example = $request->product_example;
            $subcategory->additional_fields = json_encode($fields);
            $subcategory->status ='Active';
            $subcategory->created_at=Carbon::now()->format('Y-m-d H:i:s');
            $subcategory->save();   
        return redirect()->route('subcategory')->with('success', 'Subcategory added successfully!');
        }

        public function getvalue()
  {

    $getdata =  DB::table('subcategories')->where('subcategoryId',$_POST['subcategoryId'])->first();
    
    return response()->json([
        "id" =>$getdata->subcategoryId, 
        "categoryId" =>$getdata->categoryId, 
        "name" =>$getdata->name,
        ]);
  }

  public function edit($id)
  {
   
    $subcategory=Subcategory::findOrFail($id);
   
    $categories = Category::all();
    //print_r($categories); exit;
    $subcategory1=Subcategory::all();
    $categoriesfields = Category::where('categoryId',$subcategory->categoryId)->first();
    $additionalFields = json_decode($subcategory->additional_fields, true);
    //echo "<pre>"; print_r($additionalFields); exit;
    return view('admin.subcategory.edit', compact('subcategory', 'categories', 'categoriesfields', 'additionalFields','subcategory1'));

  }
  public function update(Request $request, $id)
{ 
   //dd($id);
    $additionalFields = [];
    $fieldNames = $request->input('field_name', []);
    $fieldTypes = $request->input('field_type', []);
    $dataTypes = $request->input('data_type', []);
    $isRequired = $request->input('is_required', []);
    $isFilter = $request->input('is_filter', []);
    $examples = $request->input('example', []);

    foreach ($fieldNames as $index => $fieldName) {
      // echo "<pre>";
      // echo str_replace(' ','_',$fieldName);
        $additionalFields[] = [
            'field_name'   => str_replace(' ','_',$fieldName),
            'field_type'   => $fieldTypes[$index] ?? '',
            'data_type'    => $dataTypes[$index] ?? '',
            'is_required'  => $isRequired[$index] ?? '',
            'is_filter'    => $isFilter[$index] ?? '',
            'example'      => $examples[$index] ?? '',
        ];
    }
   
    $Data = [
        'categoryId'        => $request['categoryId'],
        'name'              => $request['name'],
        'brand_example'     => $request['brand_example'],
        'product_example'   => $request['product_example'],
        'additional_fields' => json_encode($additionalFields), 
    ];

    DB::table('subcategories')->where('subcategoryId', $id)->update($Data);

    return redirect()->route('subcategory')->with('success', 'Subcategory updated successfully!');
}


   function subcategory_delete($subcategoryId)
   {

         $delete = DB::table('subcategories')->where('subcategoryId', $subcategoryId)->delete();
         return redirect()->route('subcategory')->with('success', 'Subcategory saved successfully!');
   }
    
}