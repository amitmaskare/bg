<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
class SettingController extends Controller
{
    
    public function index()
    {
        $data['title']="Setting";
        $data['heading']="Setting";
        $data['page']="setting";
        $data['setting']=Setting::where('id','1')->first();
        return view('admin.setting',compact('data'));
    }

    // public function logo_setting(Request $request)
    // {
    //     $validator=Validator::make($request->all(),[
    //         'website_name'=>['required'],
    //     ]);
    //     if($validator->fails())
    //     {
    //         return back()->withError($validator)->withInput();
    //     }
    //     $setting=Setting::findOrFail($request->id);
    //     $setting->website_name=$request->website_name;
    //     $setting->save();
    //     Session()->flash('success',"Logo setting updated successfully");
    //     return back();
    // }

  public function logo_setting(Request $request)
{
    $validator = Validator::make($request->all(), [
        'website_name' => ['required', 'string'],
        'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        'favicon' => ['nullable', 'image', 'mimes:jpeg,png,ico', 'max:1024'],
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $setting = Setting::findOrFail($request->id);
    $setting->website_name = $request->website_name;

    // Handle logo upload
    if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        $logoName = time() . '_logo.' . $logo->getClientOriginalExtension();
        $logo->move(public_path('uploads/settings'), $logoName);

        // Delete old logo if it exists
        if ($request->old_logo && file_exists(public_path('uploads/settings/' . $request->old_logo))) {
            unlink(public_path('uploads/settings/' . $request->old_logo));
        }

        $setting->logo = $logoName;
    }

    // Handle favicon upload
    if ($request->hasFile('favicon')) {
        $favicon = $request->file('favicon');
        $faviconName = time() . '_favicon.' . $favicon->getClientOriginalExtension();
        $favicon->move(public_path('uploads/settings'), $faviconName);

        // Delete old favicon if it exists
        if ($request->favicon_logo && file_exists(public_path('uploads/settings/' . $request->favicon_logo))) {
            unlink(public_path('uploads/settings/' . $request->favicon_logo));
        }

        $setting->favicon = $faviconName;
    }

    $setting->save();

    session()->flash('success', "Settings updated successfully.");
    return back();
}

    public function site_setting(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'address'=>['required'],
            'email'=>['required'],
            'phone'=>['required'],
        ]);
        if($validator->fails())
        {
            return back()->withError($validator)->withInput();
        }
        $setting=Setting::findOrFail($request->setting_id);
        $setting->address=$request->address;
        $setting->email=$request->email;
        $setting->phone=$request->phone;
        $setting->facebook=$request->facebook;
        $setting->instagram=$request->instagram;
        $setting->twitter=$request->twitter;
        $setting->youtube=$request->youtube;
        $setting->save();
        Session()->flash('success',"Site setting updated successfully");
        return back();

    }
}
