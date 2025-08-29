<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use DB;
class BlogController extends Controller
{
    public function index()
    {
        $blog = Blog::latest()->get();
        return view('admin.blog.blog', compact('blog'));
    }
public function ajax_manage_page(Request $request)
{
    $Blog = new Blog();
    $getData = $Blog->getDatatables($request);

    $start = $request->input('start', 0);
    $draw = $request->input('draw', 1);
    $data = [];
    $no = $start;

    foreach ($getData as $item) {
        $no++;

        // ✅ Image column logic
        if ($item->image && file_exists(public_path('uploads/blogs/' . $item->image))) {
            $img = '<img src="' . asset('uploads/blogs/' . $item->image) . '" width="70px" height="70px">';
        } else {
            $img = '<img src="' . asset('assets/images/product-details/product/1.jpg') . '" width="70px" height="70px">';
        }

        // ✅ Action buttons
        $btn = '';

        // Replace with your policy checks if needed
        // if (auth()->user()->can('blog-update')) {
            $btn .= '<a href="' . route('blog.edit', $item->blog_id) . '" class="btn-success btn-sm">Edit</a> ';
        // }

        // if (auth()->user()->can('blog-delete')) {
            $btn .= '<form action="' . route('blog.delete', $item->blog_id) . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Are you sure you want to delete this blog?\');">'
                . csrf_field()
                . method_field('DELETE')
                . '<button type="submit" class="btn-sm btn-danger">Delete</button></form>';
        // }

        $nestedData = [];
        $nestedData[] = $no;
        $nestedData[] = $item->title;
        $nestedData[] = $img;
        $nestedData[] = $item->description;
        $nestedData[] = date('d-M-Y H:i A', strtotime($item->created_at));
        $nestedData[] = $btn;

        $data[] = $nestedData;
    }

    $output = [
        "draw" => $draw,
        "recordsTotal" => $Blog->countAll(),
        "recordsFiltered" => $Blog->countFiltered($request),
        "data" => $data,
    ];

    return response()->json($output);
}  

    public function addBlog()
    {
        return view('admin.blog.addblog');
    }

    public function saveBlogs(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description' => 'required|string',
    ]);
    
    // Handle image upload
    $imageName = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/blogs'), $imageName);
    }

    // Insert into database
    Blog::create([
        'title' => $request->input('title'),
        'image' => $imageName,
        'description' => $request->input('description'),
    ]);
    return redirect()->route('blog')->with('success', 'Blog created successfully!');
}
public function edit($id)
{
    $blog = Blog::findOrFail($id);
    return view('admin.blog.edit', compact('blog'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $blog = Blog::findOrFail($id);

    // Handle image if uploaded
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/blogs'), $imageName);

        // Optional: delete old image if needed
        if ($blog->image && file_exists(public_path('uploads/blogs/' . $blog->image))) {
            unlink(public_path('uploads/blogs/' . $blog->image));
        }

        $blog->image = $imageName;
    }

    $blog->title = $request->input('title');
    $blog->description = $request->input('description');
    $blog->save();

    return redirect()->route('blog')->with('success', 'Blog updated successfully!');
}
public function destroy($id)
{
    $blog = Blog::findOrFail($id);

    // Delete image from folder
    if ($blog->image && file_exists(public_path('uploads/blogs/' . $blog->image))) {
        unlink(public_path('uploads/blogs/' . $blog->image));
    }

    // Delete blog from DB
    $blog->delete();

    return redirect()->route('blog')->with('success', 'Blog deleted successfully!');
}
}
?>