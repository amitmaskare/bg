<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Weight;
use Carbon\Carbon;
use DB;
class WeightController extends Controller
{
    public function index()
    {
      $data['weight']=Weight::all();
      return view('admin.weight',compact('data'));  
    }

    public function saveWeight(Request $request)
    {
        Weight::create([
        'weight' => $request->weight,
        'status' => 'Active',
        'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),

    ]);

    return redirect()->route('weight')->with('success', 'Weight saved successfully!');
    }


    public function saveMeasureAjax(Request $request)
    {
        $weight = Weight::create([
            'weight' => $request->measure_name,
            'status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
      
        return response()->json([
            'success' => true,
            'measure' => $weight,
        ]);
    }
    
    public function getvalue()
    {
  
      $getdata =  DB::table('weights')->where('weightId',$_POST['weightId'])->first();
   
      return response()->json([
          "id" =>$getdata->weightId, 
          "name" =>$getdata->weight,
          ]);
    }
     public function weight_update(Request $request)
     {
        
        $Data = array(
           'weight'  =>$request['weight'],
        );
  
        DB::table('weights')->where('weightId', $request['weightId'])->update($Data);
        return redirect()->route('weight')->with('success', 'weight saved successfully!');
     }
  
     function weight_delete($weightId)
     {
  
           $delete = DB::table('weights')->where('weightId', $weightId)->delete();
           return redirect()->route('weight')->with('success', 'weight saved successfully!');
     }
  

}