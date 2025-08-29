<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Template, EmailTemplate};
use Illuminate\Support\Facades\Validator;
class TemplateController extends Controller
{
     function index()
    {
        $data['template']=Template::all();
        $data['title'] = "Template";
        $data['heading'] = "Template List";
        $data['page'] = "template";
        return view('admin.template.list', compact('data'));
    }

    public function ajax_manage_page(Request $request)
    {
        $template = new Template();
        $getData = $template->getDatatables($request);
        $start = $request->input('start', 0);
        $draw = $request->input('draw', 1);
        $data = [];
        $no = $start;
        foreach ($getData as $row) {

            $btn = '<div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="icon-base bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="' . route('template.edit', ['id' => $row->template_id]) . '"><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a>';

            $btn .= '<a class="dropdown-item" href="javascript:void(0);" onclick="deleteItem(' . $row->template_id . ')"><i class="icon-base bx bx-trash me-1"></i> Delete</a>
                  </div>
                </div>';

            $active = $row->template_active == 'Y' ? '<span class="badge bg-label-primary me-1 btn btn-sm">Y</span>' : '<span class="badge bg-label-danger me-1 btn btn-sm">N</span>';

            $no++;
            $nestedData = [];
            $nestedData[] = $no;
            $nestedData[] = ucfirst($row->template_name);
            $nestedData[] = ucfirst($row->template_campaign);
            $nestedData[] = $active;
            $nestedData[] = $row->template_type;
            $nestedData[] = $btn;
            $data[] = $nestedData;
        }

        $output = [
            "draw" => $draw,
            "recordsTotal" => $template->countAll(),
            "recordsFiltered" => $template->countFiltered($request),
            "data" => $data,
        ];

        return response()->json($output);
    }

    function add()
    {
        $data['title'] = "Add Template";
        $data['heading'] = "Add Template";
        $data['page'] = "template";
        return view('admin.template.add', compact('data'));
    }

    function saveTemplate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'template_name' => ['required'],
            'type' => ['required'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $templateId = $request->id;
        if (isset($templateId)) {
            $template = Template::find($templateId);
            $msg = 'updated';
        } else {
            $template = new Template();
            $msg = "added";
        }

        $template->template_name = $request->template_name;
        $template->status = $request->status;
        $template->type = $request->type;
        $template->langauge = $request->language;
        $template->save();
        session()->flash('success', "Template {$msg} successfully");
        return redirect()->route('template');
    }

    function edit($id)
    {
        $data['title'] = "Edit Template";
        $data['heading'] = "Edit Template";
        $data['page'] = "template";
        $data['template'] = Template::findOrFail($id);
        return view('admin.template.add', compact('data'));
    }

    function delete($id)
    {
        $template = Template::findOrFail($id);
        $template->delete();
        session()->flash('success', "Template deleted successfully");
        return redirect()->route('template');
    }

    function email_template(){
        $data['template']=Template::all();
        $data['title'] = "Email Template";
        $data['heading'] = "Email Template List";
        $data['page'] = "email-template";
        $data['add_cart']=EmailTemplate::where('type','add_cart')->first();
        $data['remove_cart']=EmailTemplate::where('type','remove_cart')->first();
        $data['expiring_soon']=EmailTemplate::where('type','expiring_soon')->first();
        $data['bid_accept']=EmailTemplate::where('type','bid_accept')->first();
        $data['outbid']=EmailTemplate::where('type','outbid')->first();
        $data['reject']=EmailTemplate::where('type','reject')->first();
        $data['counter']=EmailTemplate::where('type','counter')->first();
        $data['buy']=EmailTemplate::where('type','buy')->first();
        $data['order']=EmailTemplate::where('type','order')->first();
        $data['ship']=EmailTemplate::where('type','ship')->first();
        return view('admin.template.email-template', compact('data'));
    }

    function updateEmailTemplate(Request $request)
    {
        EmailTemplate::updateOrCreate(
            ['type' => $request->type],
            ['subject' => $request->subject, 'body' => $request->body]
        );

        return back()->with('success', 'Template updated!');
    }

   
}
