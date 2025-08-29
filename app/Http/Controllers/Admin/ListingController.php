<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product,Category,Subcategory,Currency,Listingproduct,productImage,Brand,Weight,ListingLog,StockLocation};
use Carbon\Carbon;
use DB;
use Illuminate\Support\Str;
use Session;
class ListingController extends Controller
{

    public function index()
    {
      $query = DB::table('listing_products as p')
    ->join('products as prod', 'prod.productId', '=', 'p.productId')
    ->select('p.*', 'prod.name');
      if (Session::get('role') == 'seller') {
        $query->where('sellerId', Session::get('id'));
        }
      $data['product'] = $query->get();
      return view('admin.listing_product.list',compact('data'));  
    }


    function addlistingproduct()
    {
        $data['category']=Category::all();
        $data['subcategory']=Subcategory::all();
        $data['brand']=Brand::all();
        $data['product']=Product::all();
        $data['currency']=Currency::all();
        $data['manufacture']=Weight::all();
        $data['stocklocation']=StockLocation::all();
      return view('admin.listing_product.add',compact('data')); 
    }

    function getProductData(Request $request)
    {
      $product=Product::where('categoryId',$request['categoryId'])->where('subcategoryid',$request['subcategoryId'])->get();
      $html='<option value="">Select</option>';
      if($product)
      {
        foreach($product as $key)
        {
          $html.='<option value="'.$key->productId.'">'.ucwords($key->name).'</option>';
        }
      }
      echo $html;
    }

    function getProductValue(Request $request)
    {
      if(!$request->productId)
      {
        return response()->json([
          'data'=>0,
        ]);
      }
       $getdata=Product::where('productId',$request->productId)->first();
      if($getdata['main_image'] && file_exists(public_path('uploads/product/'.$getdata['main_image'])))
      {
        $img='<img src="'.asset('uploads/product/'.$getdata['main_image']).'" width="100px" height="100px"/>';
      }
      else{
        $img='<img src="'.asset('admin/images/pro3/1.jpg').'" width="100px" height="100px"/>';
      }
      $productImage=productImage::where('productId',$request->productId)->get();
      $otherImg=[];
      if($productImage)
      {
        foreach($productImage as $key)
        {
          $otherImg[]='<img src="'.asset('uploads/product/'.$key->other_image).'" width="100px" height="100px" class="img-fluid me-3"/>';
        }
      }
       return response()->json([
        'data'=>1,
        "product_name" =>$getdata['name'],
        "mrp" =>$getdata['mrp'],
        "price" =>$getdata['price'],
        "discount" =>$getdata['discount'],
        "offer" =>$getdata['offer'],
       "description" =>$getdata['description'],
       "slug_url" =>$getdata['slug_url'],
       "img" =>$img,
       "main_image" =>$getdata['main_image'],
       "otherImg" =>$otherImg,
       "weightId" =>$getdata['weightId'],
       "length" =>$getdata['length'],
       "breadth" =>$getdata['breadth'],
       "height" =>$getdata['height'],
       "manufacture" =>$getdata['manufacture'],
       "supplier" =>$getdata['supplier'],
       "upc" =>$getdata['upc'],
       "ean" =>$getdata['ean'],
       "gst" =>$getdata['gst'],
       "specification" =>$getdata['specification'],
        ]);
    }


    function savelistingproduct(Request $request)
    {
     
      
      $main_image = $request['old_image'];
      if ($request->hasFile('main_image')) {
          $file = $request->file('main_image');
          $filename = rand(0000,9999) . "_" . preg_replace('/[()\s]/', '', $file->getClientOriginalName());
          $file->move(public_path('uploads/product'), $filename);
          $main_image = $filename;
      }
      
      $otherImages = [];

    if ($request->hasFile('other_image')) {
        foreach ($request->file('other_image') as $file) {
            if ($file->isValid()) {
                $filename = Str::random(10) . '_' . preg_replace('/[()\s]/', '', $file->getClientOriginalName());
                $file->move(public_path('uploads/product'), $filename);
                $otherImages[] = $filename;
            }
        }
    }

      $getdata =  DB::table('products')->where('productId',$request->productId)->first();
  
      $additionalFields=$getdata->additional_fields;
      Listingproduct::create([
         'sellerId'=>Session::get('id'),
         'categoryId'=>$request->categoryId,
         'subcategoryId'=>$request->subcategoryId,
         'productId'=>$request->productId,
         'brandId'=>$request->brandId,
         'type'=>$request->type,
         'additional_fields'=>$additionalFields,
         'product_name'=>$request->product_name,
         'quantity'=>$request->quantity,
         'mrp'=>$request->mrp,
         'price'=>$request->price,
         'discount'=>$request->discount,
         'offer'=>$request->offer,
         'status'=>'pending',
         'description'=>$request->description,
         'main_image'=>$main_image,
         'other_image'=>json_encode($otherImages),
         'sale_type'=>$request->sale_type,
         'item_condition'=>$request->item_condition,
         'quality'=>$request->quality,
         'estimated_purchasedate'=>$request->estimated_purchasedate,
         'slug_url'=>$request->slug_url,
         'specification'=>$request->specification,
         'weightId'=>$request->weightId,
         'length'=>$request->length,
         'breadth'=>$request->breadth,
         'height'=>$request->height,
         'manufacture'=>$request->manufacture,
         'supplier'=>$request->supplier,
         'upc'=>$request->upc,
         'ean'=>$request->ean,
         'gst'=>$request->gst,
         'status'=>$request->status,
         'type'=>'sale',
         'stock_location_id' =>$request->stock_location_id,
         'shipping_include' =>$request->shipping_include,
         'kilometer' =>$request->kilometer,
         'feature_product' =>$request->feature_product,
         'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
        ]);
 
      //    $count=count(array_filter($_FILES['image']['name']));
 
      //  for ($j=0; $j < $count; $j++)
      //  {
      //     if($_FILES['image']['name'][$j]!='')
      //    {
      //         $src = $_FILES['image']['tmp_name'][$j];
      //          $filEnc = time();
      //          $avatar= rand(0000,9999)."_".$_FILES['image']['name'][$j];
      //          $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
      //          $dest =public_path().'/uploads/product/'.$avatar1;
      //        if(move_uploaded_file($src,$dest))
      //        {
      //                $image  = $avatar1;             
      //        }
      //    }
      //    else
      //    {
      //        $image  ="";
      //    }
 
      //    $log = array(
      //      'productId' =>$lastId,
      //      'image' =>$image,
      //      'created_at' =>date('Y-m-d H:i:s'),
      //    );
 
      //   DB::table('product_images')->insert($log);
      //  }
 
       return redirect()->route('listingproduct')->with('success', 'Listing product saved successfully!');
     
    }


    public function edit($id)
{  
      
     $listingproduct = Listingproduct::findOrFail($id); 
    

     if($listingproduct->status=='published' || ((Session::get('role')=='seller') && ($listingproduct->sellerId!=Session::get('adminId'))))
      {
      return  redirect()->route('listingproduct');
      }
     $productfields = Product::where('productId',$listingproduct->productId)->first();
     $fields = DB::table('products')->where('productId', $listingproduct->productId)->first();
    // $getStocklocation = DB::table('stocklocations')->where('id', $listingproduct->stock_location_id)->first();

     //$fields=json_decode($productfields->additional_fields);
     $stocklocation=StockLocation::all();
     $products= Product::all();
     $categories = Category::all();
     $subcategories = Subcategory::all();
     $brands=Brand::all();
    $currency = Currency::all(); 
    $manufacture=Weight::all(); 
    return view('admin.listing_product.edit', compact('listingproduct', 'categories', 'subcategories','currency','fields','products','brands','manufacture','stocklocation'));
   
}  

// public function update(Request $request, $id)
// {   

//     $listingproduct = Listingproduct::where('id', $id)->firstOrFail();

//     $main_image = $request->old_mainimage;
//       if ($request->hasFile('main_image')) {
//           $file = $request->file('main_image');
//           $filename = rand(0000,9999) . "_" . preg_replace('/[()\s]/', '', $file->getClientOriginalName());
//           $file->move(public_path('uploads/product'), $filename);
//           $main_image = $filename;
//       }

//       $otherImages = [];

//       if ($request->hasFile('other_image')) {
//           foreach ($request->file('other_image') as $file) {
//               if ($file->isValid()) {
//                   $filename = Str::random(10) . '_' . preg_replace('/[()\s]/', '', $file->getClientOriginalName());
//                   $file->move(public_path('uploads/product'), $filename);
//                   $otherImages[] = $filename;
//               }
//           }
//           $other_image=json_encode($otherImages);
//       }
//       else{
//         $other_image=$request->old_otherimage;
//       }
//      //print_r(json_encode($otherImages)); exit;
//       $getdata =  DB::table('products')->where('productId',$request['productId'])->first();
//       $additionalFields=$getdata->additional_fields;
//      // dd($additionalFields);
      
//     // Update fields
    
//     $listingproduct->categoryId = $request->categoryId;
//     $listingproduct->subcategoryId = $request->subcategoryId;
//     $listingproduct->brandId = $request->brandId;
//     $listingproduct->productId = $request->productId;
//     $listingproduct->type = $request->type; 
//     $listingproduct->sale_type = $request->sale_type;
//     $listingproduct->estimated_purchasedate = $request->estimated_purchasedate;
//     $listingproduct->quality = $request->quality;
//     $listingproduct->quantity = $request->quantity;
//     $listingproduct->price = $request->price;
//     $listingproduct->item_condition = $request->item_condition;

//     $listingproduct->status = $request->status;

//     $listingproduct->description = $request->description;
//     $listingproduct->main_image = $main_image;
//     $listingproduct->other_image =$other_image ;
//     $listingproduct->additional_fields = $additionalFields;
//    $listingproduct->specification=$request->specification;
//         $listingproduct->weightId=$request->weightId;
//         $listingproduct->length=$request->length;
//         $listingproduct->breadth=$request->breadth;
//         $listingproduct->height=$request->height;
//         $listingproduct->manufacture=$request->manufacture;
//         $listingproduct->supplier=$request->supplier;
//         $listingproduct->upc=$request->upc;
//         $listingproduct->ean=$request->ean;
//         $listingproduct->gst=$request->gst;
//     $listingproduct->save();

       

//     return redirect()->route('listingproduct')->with('success', 'Listingproduct updated successfully!');
    
// }
public function update(Request $request, $id)
{
  
    $listingproduct = Listingproduct::where('id', $id)->firstOrFail();

    // Handle main image
    $main_image = $request->old_mainimage;
    if ($request->hasFile('main_image')) {
        $file = $request->file('main_image');
        $filename = rand(0000,9999) . "_" . preg_replace('/[()\s]/', '', $file->getClientOriginalName());
        $file->move(public_path('uploads/product'), $filename);
        $main_image = $filename;
    }

    // Handle other images
    $otherImages = json_decode($request->old_otherimage ?? '[]', true);

    // If remove image checked
    if ($request->has('remove_otherimage')) {
        foreach ($request->remove_otherimage as $remove) {
            if (($key = array_search($remove, $otherImages)) !== false) {
                unset($otherImages[$key]);
                // Optional: Delete file physically
                $path = public_path('uploads/product/'.$remove);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }
    }

    // Add newly uploaded images
    if ($request->hasFile('other_image')) {
        foreach ($request->file('other_image') as $file) {
            if ($file->isValid()) {
                $filename = Str::random(10) . '_' . preg_replace('/[()\s]/', '', $file->getClientOriginalName());
                $file->move(public_path('uploads/product'), $filename);
                $otherImages[] = $filename;
            }
        }
    }

    // Get additional fields
    $getdata = DB::table('products')->where('productId', $request->productId)->first();
    $additionalFields = $getdata->additional_fields;

    // Update fields
    $listingproduct->categoryId = $request->categoryId;
    $listingproduct->subcategoryId = $request->subcategoryId;
    $listingproduct->brandId = $request->brandId;
    $listingproduct->productId = $request->productId;
    $listingproduct->type = $request->type;
    $listingproduct->sale_type = $request->sale_type;
    $listingproduct->estimated_purchasedate = $request->estimated_purchasedate;
    $listingproduct->quality = $request->quality;
    $listingproduct->quantity = $request->quantity;
    $listingproduct->product_name = $request->product_name;
    $listingproduct->mrp = $request->mrp;
    $listingproduct->price = $request->price;
    $listingproduct->discount = $request->discount;
    $listingproduct->offer = $request->offer;
    $listingproduct->item_condition = $request->item_condition;
    $listingproduct->status = $request->status;
    $listingproduct->description = $request->description;
    $listingproduct->main_image = $main_image;
    $listingproduct->other_image = json_encode(array_values($otherImages)); // Save merged other images
    $listingproduct->additional_fields = $additionalFields;
    $listingproduct->specification = $request->specification;
    $listingproduct->weightId = $request->weightId;
    $listingproduct->length = $request->length;
    $listingproduct->breadth = $request->breadth;
    $listingproduct->height = $request->height;
    $listingproduct->manufacture = $request->manufacture;
    $listingproduct->supplier = $request->supplier;
    $listingproduct->upc = $request->upc;
    $listingproduct->ean = $request->ean;
    $listingproduct->stock_location_id = $request->stock_location_id ?? 0;
    $listingproduct->gst = $request->gst;
    $listingproduct->shipping_include = $request->shipping_include;
    $listingproduct->kilometer = $request->kilometer;
    $listingproduct->expirydate = $request->expirydate;
     $listingproduct->feature_product = $request->feature_product;

    $listingproduct->save();

    return redirect()->route('listingproduct')->with('success', 'Listingproduct updated successfully!');
}

public function view($id)
{  
  
     $listingProduct = Listingproduct::leftjoin('categories as cat','listing_products.categoryId', '=', 'cat.categoryId')->leftjoin('subcategories as sub','listing_products.subcategoryId', '=', 'sub.subcategoryId')->leftjoin('products as p','listing_products.productId','=','p.productId')->where('listing_products.id',$id)->select('listing_products.*','cat.categoryName','sub.name as subcategory_name','p.name as product_name')->first();
    
    return view('admin.listing_product.view', compact('listingProduct'));
   
}  

  function updateStatus(Request $request)
  {
 
    $log=array(
      'listingId'=>$request['id'],
      'userId'=>0,
      'adminId'=>Session::get('adminId'),
      'action'=>$request['status'],
      'notes'=>$request['notes'],
      'created_at'=>date('Y-m-d H:i:s')
    );

   DB::table('listing_logs')->insert($log);
   if($request['status']=='published')
   {
      $updateStatus=array(
        'status'=>'published',
      );
      DB::table('listing_products')->where('id',$request['id'])->update($updateStatus);
   }
   if($request['status']=='edit')
   {
    return redirect()->to('listingproduct/edit/'.$request['id'])->with('success', 'Listing Product saved successfully!');
   }
   else{
   return redirect()->route('listingproduct')->with('success', 'Listing Product saved successfully!');
   }

  }


    function delete($id)
  {
    $delete = DB::table('listing_products')->where('id', $id)->delete();
    return redirect()->route('listingproduct')->with('success', 'product deleted successfully!');
  }

  function getadditionalfieldInListing_old(Request $request)
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
          $fieldName=str_replace('_',' ',$key->field_name);
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
      echo $html;
    }

    public function getadditionalfieldInListing(Request $request)
{
    $getdata = DB::table('products')->where('productId', $request['productId'])->first();

    $fields = json_decode($getdata->additional_fields, true); 
    $html = '';

    if ($fields) {
        foreach ($fields as $key => $values) {
            $label = ucwords(str_replace('_', ' ', $key)); 
            $value = isset($values[0]) ? $values[0] : '';

            $html .= '<div class="form-group">
                        <label class="col-form-label pt-0">' . $label . '</label>
                        <input class="form-control" type="text" name="' . $key . '[]" value="' . htmlspecialchars($value) . '">
                    </div>';
        }
    }

    echo $html;
}

  function listinglogs()
  {
    $data['logs']=DB::table('listing_logs as log')
    ->join('listing_products as list', 'list.id', '=', 'log.listingId')
    ->join('products as prod', 'prod.productId', '=', 'list.productId')
    ->join('admins as admin', 'admin.adminId', '=', 'log.adminId')
    ->select('log.*','admin.name','prod.name as product_name')
   
    ->get();
    
  return view('admin.listing_product.listing_log',compact('data'));   
  }

  function bidlist()
  {
    $data['title']="Bid List";
    return view('admin.listing_product.bidlist');
  }
  public function getproductInfoforView()
  {

   // $getdata =  DB::table('listing_products')->where('id',$_POST['produId'])->first();
    $listingProduct = Listingproduct::leftjoin('categories as cat','listing_products.categoryId', '=', 'cat.categoryId')->leftjoin('subcategories as sub','listing_products.subcategoryId', '=', 'sub.subcategoryId')->leftjoin('products as p','listing_products.productId','=','p.productId')->where('listing_products.id',$_POST['produId'])->select('listing_products.*','cat.categoryName','sub.name as subcategory_name','p.name as product_name')->first();
    $sale_type = ($listingProduct['sale_type']=='1') ? 'Single Pieces':'Whole Sells';
    $date = date('d M Y',strtotime($listingProduct['estimated_purchasedate']));
    $valueField = json_decode($listingProduct['additional_fields'] ?? '{}', true); 
   

    $extraFields = [];
    if (!empty($valueField)) {
        foreach ($valueField as $key => $value) {
            $extraFields[$key] = is_array($value) && isset($value[0]) ? $value[0] : 'N/A';
        }
    }
    return response()->json([
      "categoryName" => $listingProduct['categoryName'],
      "subcategory_name" => $listingProduct['subcategory_name'],
      "product_name" => $listingProduct['product_name'],
      "type" => $listingProduct['type'],
      "sale_type" => $sale_type,
      "quality" => $listingProduct['quality'],
      "date" => $date,
      "quantity" => $listingProduct['quantity'],
      "price" => $listingProduct['price'],
      "item_condition" => $listingProduct['item_condition'],
      "status" => $listingProduct['status'],
      "description" => $listingProduct['description'],
      "extra_fields" => $extraFields ,// pass the dynamic data as its own array
      "length" => $listingProduct['length'],
      "breadth" => $listingProduct['breadth'],
      "height" => $listingProduct['height'],
      "weightId" => $listingProduct['weightId'],
      "manufacture" => $listingProduct['manufacture'],
      "supplier" => $listingProduct['supplier'],
      "upc" => $listingProduct['upc'],
      "ean" => $listingProduct['ean'],
      "gst" => $listingProduct['gst'],
      "stock_location_id" => $listingProduct['stock_location_id'],
      "estimated_purchasedate" => $listingProduct['estimated_purchasedate'],
      "currencyId" => $listingProduct['currencyId'],
      "expirydate" => $listingProduct['expirydate'],
      "specification" => $listingProduct['specification'],
      "main_image" => $listingProduct['main_image'],
      "other_image" => json_decode($listingProduct['other_image'],true),
 
  ]);
  }

  function changeStatus(Request $request)
  { 
      
      $listing=Listingproduct::find($request['id']);
      $listing->status=$request->status;
      $listing->save();
      echo "1";

  }

    


}
