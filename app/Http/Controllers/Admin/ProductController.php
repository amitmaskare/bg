<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validation;
use App\Models\{Product,ProductImage,Category,Subcategory,Brand,Weight,Currency};
use Carbon\Carbon;
use DB;
use Illuminate\Support\Str;
class ProductController extends Controller
{

    public function index()
    {
      $data['product']=DB::table('products as p')->where('p.sellerId',session('id'))
      ->join('categories as cat', 'p.categoryId', '=', 'cat.categoryId')
      ->join('subcategories as subcat', 'p.subcategoryId', '=', 'subcat.subcategoryId')
      ->select('p.*', 'cat.categoryName','subcat.name as subcategory')
      ->get();
      return view('admin.product.list',compact('data'));  
    }

public function ajax_manage_page(Request $request)
{
    $Product = new Product();
    $getData = $Product->getDatatables($request);

    $start = $request->input('start', 0);
    $draw = $request->input('draw', 1);
    $data = [];
    $no = $start;

    foreach ($getData as $item) {
        $btn = '';

        // 👇 Permissions can be wrapped if needed
        $btn .= '<a href="' . url('admin/viewproduct/' . $item->productId) . '" class="btn-info btn-sm me-1"><i class="fa fa-eye"></i></a>';
        $btn .= '<a href="' . route('product.edit', ['id' => $item->productId]) . '" class="btn-success btn-sm me-1">Edit</a>';
        $btn .= '<a href="javascript:void(0)" onclick="deleteProduct(' . $item->productId . ')" class="btn-danger btn-sm">Delete</a>';

        // 👇 Image
        if ($item->main_image && file_exists(public_path('uploads/product/' . $item->main_image))) {
            $img = '<img src="' . asset('uploads/product/' . $item->main_image) . '" alt="" width="70px" height="70px">';
        } else {
            $img = '<img src="' . asset('assets/images/no-image.png') . '" alt="" width="70px" height="70px">';
        }

        // 👇 Status
        $status = $item->status == 1
            ? '<span class="badge bg-success">Active</span>'
            : '<span class="badge bg-danger">Inactive</span>';

        $no++;
        $nestedData = [];
        $nestedData[] = $no;
        $nestedData[] = $img;
        $nestedData[] = ucfirst($item->categoryName);
        $nestedData[] = ucfirst($item->subcategory);
        $nestedData[] = ucfirst($item->name);
        $nestedData[] = $status;
        $nestedData[] = $btn;

        $data[] = $nestedData;
    }

    $output = [
        "draw" => $draw,
        "recordsTotal" => $Product->countAll(),
        "recordsFiltered" => $Product->countFiltered($request),
        "data" => $data,
    ];

    return response()->json($output);
}
    function addproduct()
    {
        $data['category']=Category::all();
        $data['subcategory']=Subcategory::all();
        $data['brand']=Brand::all();
        $data['manufacture']=Weight::all();
        $data['currency']=Currency::all();
      return view('admin.product.add',compact('data')); 
    }

    function saveproduct(Request $request)
    {
      $main_image = '';
      if ($request->hasFile('main_image')) {
          $file = $request->file('main_image');
          $filename = rand(0000,9999) . "_" . preg_replace('/[()\s]/', '', $file->getClientOriginalName());
          $file->move(public_path('uploads/product'), $filename);
          $main_image = $filename;
      }
      $getdata =  DB::table('subcategories')->where('subcategoryId',$request['subcategoryId'])->first();
      $fields=json_decode($getdata->additional_fields);
      $additionalFields=[];
      if($fields)
      {
        foreach($fields as $key)
        {
          $fieldName = $key->field_name;
          $additionalFields[$fieldName] = $request[$fieldName];
      }
    }  
   // print_r(json_encode($additionalFields)); exit;
          $data=array(
            'categoryId'=>$request->categoryId,
            'subcategoryId'=>$request->subcategoryId,
            'brandId'=>$request->brandId,
            'sellerId'=>session('id'),
            'weightId'=>$request->weightId,
            'name'=>$request->name,
            'additional_fields'=>json_encode($additionalFields),
            'length'=>$request->length,
            'breadth'=>$request->breadth,
            'height'=>$request->height,
            'mrp'=>$request->mrp,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'offer'=>$request->offer,
            'currencyId'=>$request->currencyId,
            'manufacture'=>$request->manufacture,
            'supplier'=>$request->supplier,
            'upc'=>$request->upc,
            'ean'=>$request->ean,
            'gst'=>$request->gst,
            'specification'=>$request->specification,
            'description'=>$request->description,
            'main_image'=>$main_image,
            'slug_url'=>Str::slug($request->name),
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
       );
       $lastId=DB::table('products')->insertGetId($data);
 
         $count=count(array_filter($_FILES['other_image']['name']));
 
       for ($j=0; $j < $count; $j++)
       {
          if($_FILES['other_image']['name'][$j]!='')
         {
              $src = $_FILES['other_image']['tmp_name'][$j];
               $filEnc = time();
               $avatar= rand(0000,9999)."_".$_FILES['other_image']['name'][$j];
               $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
               $dest =public_path().'/uploads/product/'.$avatar1;
             if(move_uploaded_file($src,$dest))
             {
                     $other_image  = $avatar1;             
             }
         }
         else
         {
             $other_image  ="";
         }
 
         $log = array(
           'productId' =>$lastId,
           'other_image' =>$other_image,
           'created_at' =>date('Y-m-d H:i:s'),
         );
 
        DB::table('product_images')->insert($log);
       }
 
       return redirect()->route('product')->with('success', 'Product saved successfully!');
     
    }
   
    function getSubcategoryValue()
    {
      $getdata =  DB::table('subcategories')->where('categoryId',$_POST['categoryId'])->get();
      $html='<option value="">Select</option>';
      if($getdata)
      {
        foreach($getdata as $key)
        {
          $html.='<option value="'.$key->subcategoryId.'">'.$key->name.'</option>';
        }
      }
      echo $html;
    }

    function getadditionalfield(Request $request)
    {
      $getdata =  DB::table('subcategories')->where('subcategoryId',$request['subcategoryId'])->first();
      $fields=json_decode($getdata->additional_fields);
      $html='';
      if($fields)
      {
        foreach($fields as $key)
        {
          $required = ($key->is_required == '2') ? 'required' : '';
          $validation = ($key->is_required == '2') ? '<span>*</span>' : '';
          $fieldName=str_replace(' ','_',$key->field_name);
          if($key->field_type=='input')
          {
          $type='<input class="form-control" type="text" '.$required.' name="'.$key->field_name.'[]" >';
          }
          else{
            $type='<select class="form-control" '.$required.'  name="'.$key->field_name.'[]" ></select>'; 
          }
          $html.='<div class="form-group">
                      <label class="col-form-label pt-0">'.$validation.' '.ucwords($fieldName).' (e.g. '.$key->example.')</label>
                        '.$type.'
                      </div>';
        }
       
      }
      return response()->json([
        "html" =>$html, 
        "brand_example" =>$getdata->brand_example,
        "product_example" =>$getdata->product_example,
        ]);
    }

    public function edit($id)
{

    $product = Product::findOrFail($id);
    $subcategoryfields = Subcategory::where('subcategoryId',$product->subcategoryId)->first();
    $fields=json_decode($subcategoryfields->additional_fields);
    $product_image = ProductImage::where('productId',$id)->get();
    $categories = Category::all();
    $subcategories = Subcategory::all();
    $brands = Brand::all();
    $manufacture = Weight::all();  
    $currency = Currency::all();  
    return view('admin.product.edit', compact('product', 'categories', 'subcategories', 'brands', 'manufacture','product_image','currency','fields'));
}   

public function update(Request $request, $id)
{
  
    // Validate request
    // $request->validate([
    //     'name' => 'required|string|max:255',
    //     'categoryId' => 'required|integer',
    //     'subcategoryId' => 'required|integer',
    //     'brandId' => 'nullable|integer',
    //     'price' => 'required|numeric',
    //     'weightId' => 'nullable|string',
    //     'dimension' => 'nullable|string',
    //     'manufacture' => 'nullable|string',
    //     'supplier' => 'nullable|string',
    //     'upc' => 'required|string',
    //     'ean' => 'nullable|string',
    //     'gst' => 'required|numeric',
    //     'specification' => 'nullable|string',
    //     'description' => 'nullable|string',
    //     'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     'video' => 'nullable|mimes:mp4,mov,avi|max:10240'
    // ]);

    // Find the product
    $product = Product::where('productId', $id)->firstOrFail();
    $main_image = $request->old_mainimage;
      if ($request->hasFile('main_image')) {
          $file = $request->file('main_image');
          $filename = rand(0000,9999) . "_" . preg_replace('/[()\s]/', '', $file->getClientOriginalName());
          $file->move(public_path('uploads/product'), $filename);
          $main_image = $filename;
      }

      $getdata =  DB::table('subcategories')->where('subcategoryId',$request['subcategoryId'])->first();
      $fields=json_decode($getdata->additional_fields);
      $additionalFields=[];
      if($fields)
      {
        foreach($fields as $key)
        {
          $fieldName = $key->field_name;
          $additionalFields[$fieldName] = $request[$fieldName];
      }
    }  
   // print_r(json_encode($additionalFields)); exit;
    // Update fields

   
    $product->name = $request->name;
    $product->categoryId = $request->categoryId;
    $product->subcategoryId = $request->subcategoryId;
    $product->brandId = $request->brandId;
    $product->mrp = $request->mrp;
    $product->price = $request->price;
    $product->discount = $request->discount;
    $product->offer = $request->offer;
    $product->currencyId = $request->currencyId;
    
    $product->weightId = $request->weightId;
    $product->length = $request->length;
    $product->breadth = $request->breadth;
    $product->height = $request->height;
    $product->manufacture = $request->manufacture;
    $product->supplier = $request->supplier;
    $product->upc = $request->upc;
    $product->ean = $request->ean;
    $product->gst = $request->gst;
    $product->specification = $request->specification;
    $product->description = $request->description;
    $product->main_image = $main_image;
    $product->additional_fields = json_encode($additionalFields);
    $product->slug_url=Str::slug($request->name);
    $product->save();
    // Handle multiple images
    // if(isset($_FILES['other_image']['name']))
    // {
    // $delete = DB::table('product_images')->where('productId', $id)->delete();
    // }
    $count=count(array_filter($_FILES['other_image']['name']));
 
       for ($j=0; $j < $count; $j++)
       {
          if($_FILES['other_image']['name'][$j]!='')
         {
              $src = $_FILES['other_image']['tmp_name'][$j];
               $filEnc = time();
               $avatar= rand(0000,9999)."_".$_FILES['other_image']['name'][$j];
               $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
               $dest =public_path().'/uploads/product/'.$avatar1;
             if(move_uploaded_file($src,$dest))
             {
                     $other_image  = $avatar1;             
             }
         }
         else
         {
             $other_image  ="";
         }
 
         $log = array(
           'productId' =>$id,
           'other_image' =>$other_image,
           'created_at' =>date('Y-m-d H:i:s'),
         );
 
        DB::table('product_images')->insert($log);
       }

    // Handle video upload
    // if ($request->hasFile('video')) {
    //     $video = $request->file('video');
    //     $videoName = time() . '.' . $video->extension();
    //     $video->move(public_path('uploads/product/videos'), $videoName);
    //     $product->video = $videoName;
    // }

    return redirect()->route('product')->with('success', 'Product updated successfully!');
  
}

  function deleteImg(Request $request)
  {
    
    $productImage = ProductImage::find($request['id']);
    if($productImage && file_exists(public_path('uploads/product/'.$productImage->other_image)))
    {
        unlink(public_path('uploads/product/'.$productImage->other_image));
        $productImage->delete();
    }
      echo "1";
  }

  function delete($productId)
  {
    $delete = DB::table('products')->where('productId', $productId)->delete();
    return redirect()->route('product')->with('success', 'product deleted successfully!');
  }
  public function view($id)
  {
      $product = Product::findOrFail($id);
      $subcategoryfields = Subcategory::where('subcategoryId',$product->subcategoryId)->first();
      $fields=json_decode($subcategoryfields->additional_fields);
      $product_image = ProductImage::where('productId',$id)->get();
      $categories = Category::all();
      $subcategories = Subcategory::all();
      $brands = Brand::all();
      $manufacture = Weight::all();  
      $currency = Currency::all();  
      return view('admin.product.view', compact('product', 'categories', 'subcategories', 'brands', 'manufacture','product_image','currency','fields'));
  }  

}