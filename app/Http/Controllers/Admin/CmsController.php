<?php

// app/Http/Controllers/Admin/CmsController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;

class CmsController extends Controller
{
    public function manage()
    {
        $pages = CmsPage::all();
        $data = [
            'heading' => 'Manage CMS Pages',
            'pages' => $pages
        ];
        return view('admin.cms.manage', compact('data'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'content' => 'required',
        'title' => 'nullable|string',
        'subtitle' => 'nullable|string',
        'mission' => 'nullable|string',
        'vision' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $page = CmsPage::findOrFail($id);

    $page->content = $request->content;
    $page->title = $request->title;
    $page->subtitle = $request->subtitle;
    $page->mission = $request->mission;
    $page->vision = $request->vision;
     if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($page->image && file_exists(public_path('uploads/cms/' . $page->image))) {
            unlink(public_path('uploads/cms/' . $page->image));
        }

        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/cms'), $filename);
        $page->image = $filename;
    }

    $page->save();


   return redirect()->back()->with('success', 'CMS Page updated successfully.')->with('activeTab', $request->query('tab'));

}
public function home()
{
    $page = CmsPage::where('slug', 'home')->firstOrFail(); 
    return view('admin.cms.home', compact('page'));
}

public function editHome()
{
    $page = CmsPage::where('slug', 'home')->firstOrFail();
    return view('admin.cms.home', compact('page'));
}

public function updateHome(Request $request, $id)
{
  
    $request->validate([
        'home_heading' => 'nullable|string',
        'home_image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'home_image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'home_image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $page = CmsPage::findOrFail($id);
    $page->home_heading = $request->home_heading;

    foreach (['home_image1', 'home_image2', 'home_image3'] as $field) {
        if ($request->hasFile($field)) {
            if ($page->$field && file_exists(public_path('uploads/cms/' . $page->$field))) {
                unlink(public_path('uploads/cms/' . $page->$field));
            }

            $file = $request->file($field);
            $filename = time() . '_' . $field . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/cms'), $filename);
            $page->$field = $filename;
        }
    }

    $page->save();

    return redirect()->route('admin.cms.home')->with('success', 'Home Page CMS updated successfully.');
}


}

?>