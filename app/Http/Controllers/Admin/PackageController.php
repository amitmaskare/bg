<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Validator;
use carbon\carbon;
class PackageController extends Controller
{
    public function index()
    {
        $data['title']="Package";
        $data['heading']="Package";
        $data['page']='package';
        $data['package']=Package::all();
        return view('admin.package.list',compact('data'));
    }

    public function add()
    {
       $data['title']="Add Package";
        $data['heading']="Add Package";
        $data['page']='package';
        return view('admin.package.add',compact('data')); 
    }

    public function save(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'type'=>['required'],
            'duration'=>['required','required'],
            'amount'=>['required'],
            'specification'=>['required'],
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withError($validator)->withInpit();
        }
        if(!empty($request->packageId))
        {
            $package=Package::findOrFail($request->packageId);
            $msg="updated";
        }
        else{
          $package=new Package(); 
           $msg="added";
        }
       
        $package->type=$request->type;
        $package->duration=$request->duration;
        $package->amount=$request->amount;
        $package->specification=json_encode($request->specification);
        $package->created_at=Carbon::now();
        $package->save();
        Session()->flash('success',"Package {$msg} successfully");
        return redirect()->route('package');
    }

    public function edit($packageId)
    {
        $data['package']=Package::findOrFail($packageId);
        $data['title']="Add Package";
        $data['heading']="Add Package";
        $data['page']='package';
        return view('admin.package.add',compact('data')); 
    }

    public function delete($packageId)
    {
        Package::findOrFail($packageId)->delete();
         Session()->flash('success',"Package deleted successfully");
        return redirect()->route('package');
    }
}
