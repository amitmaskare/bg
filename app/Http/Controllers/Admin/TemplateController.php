<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Template, EmailTemplate,Trigger,WhatsappTemplate};
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
        ]);
        
        $templateId = $request->id;
        if (isset($templateId)) {
            $template = Template::find($templateId);
            $msg = 'updated';
        } else {
            $template = new Template();
            $msg = "added";
        }
        $tags = [];
        $count = count($request['tags']);
          for ($i=0; $i < $count; $i++)
         {
                 $tags[] =[
                  'tags' => $request['tags'][$i],
                 ];    
          }
        $template->template_name = $request->template_name;
        $template->tags = json_encode($tags);
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
        $data['tags'] = json_decode($data['template']->tags, true);
       
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
        $data['title'] = "Email Template";
        $data['heading'] = "Email Template List";
        $data['page'] = "email-template";
        $data['template']=Trigger::select('id','template_name')->get();
        return view('admin.template.email_template', compact('data'));
    }

    public function getTemplateData(Request $request)
    {
        
        if(!empty($request->template_id))
        {
            $getData=EmailTemplate::where('template_id',$request->template_id)->first();
           
            $templateData=Trigger::find($request->template_id);
            $tags=json_decode($templateData->fields,true);
           
            $html='';
            if(!empty($getData))
            {
                
                $html.='<div class="row">
                                                <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Subject</label>
                                            <input type="text" class="form-control" name="subject" id="subject" value="'.$getData->subject.'" required>
                                            </div>
                                             <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Tags</label>
                                              <select name="tags" id="tags" class="form-control" onchange="getTags(this.value)">
                                                <option value="">Select</option>';
                                                if(!empty($tags)){
                                                    foreach($tags as $item){
                                                $html.='<option value="{'.$item['tags'].'}">{'.$item['tags'].'}</option>';
                                                    }}
                                              $html .='</select>
                                            </div>       
                                        <input type="hidden" name="type" value="'.$templateData->type.'">
                                         <div class="col-md-12 mt-3">
                                        <label>Body</label>
                                        <textarea name="body" class="form-control ckeditor" rows="8" id="editor1">'.$getData->body.'</textarea>
                                    </div>

                                         </div>';
            }
            else{
                 $html.='<div class="row">
                                                <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Subject</label>
                                            <input type="text" class="form-control" name="subject" id="subject" required>
                                            </div>
                                             <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Tags</label>
                                              <select name="tags" id="tags" class="form-control" onchange="getTags(this.value)">
                                                <option value="">Select</option>';
                                                if(!empty($tags)){
                                                    foreach($tags as $item){
                                                $html.='<option value="{'.$item['tags'].'}">{'.$item['tags'].'}</option>';
                                                    }}
                                              $html .='</select>
                                            </div>       
                                        <input type="hidden" name="type" value="'.$templateData->type.'">
                                        
                                        <div class="col-md-12 mt-3">
                                        <label>Body</label>
                                        <textarea name="body" class="form-control" rows="8" id="editor1"></textarea>
                                       
                                    </div>

                                         </div>';
            }

            return response()->json([
                'html'=>$html,
                'subject'=>!empty($getData->subject) ? $getData->subject:$templateData->template_name,
            ]);
           // echo $html;
        }
    }

    function updateEmailTemplate(Request $request)
    {
       
        EmailTemplate::updateOrCreate(
            ['template_id' => $request->template_id],
            ['subject' => $request->subject, 
            'body' => $request->body,
            'type'=>$request->type
            ]
        );

        return back()->with('success', 'Template updated!');
    }

    function whatsapp_template(){
        $data['title'] = "Whatsapp Template";
        $data['heading'] = "Whatsapp Template";
        $data['page'] = "whatsapp-template";
        $data['template']=Trigger::select('id','template_name')->get();
        return view('admin.template.whatsapp_template', compact('data'));
    }

    public function getWhatsappTemplate(Request $request)
    {
        
        if(!empty($request->template_id))
        {
            $getData=WhatsappTemplate::where('template_id',$request->template_id)->first();
           
            $templateData=Trigger::find($request->template_id);
            $tags=json_decode($templateData->fields,true);
           
            $html='';
            if(!empty($getData))
            {
                
                $html.='<div class="row">
                                                <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Subject</label>
                                            <input type="text" class="form-control" name="subject" id="subject" value="'.$getData->subject.'" required>
                                            </div>
                                             <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Tags</label>
                                              <select name="tags" id="tags" class="form-control" onchange="getTags(this.value)">
                                                <option value="">Select</option>';
                                                if(!empty($tags)){
                                                    foreach($tags as $item){
                                                $html.='<option value="{'.$item['tags'].'}">{'.$item['tags'].'}</option>';
                                                    }}
                                              $html .='</select>
                                            </div>       
                                        <input type="hidden" name="type" value="'.$templateData->type.'">
                                         <div class="col-md-12 mt-3">
                                        <label>Body</label>
                                        <textarea name="body" class="form-control ckeditor" rows="8" id="editor1">'.$getData->body.'</textarea>
                                    </div>

                                         </div>';
            }
            else{
                 $html.='<div class="row">
                                                <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Subject</label>
                                            <input type="text" class="form-control" name="subject" id="subject" required>
                                            </div>
                                             <div class="col-md-6">  
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Tags</label>
                                              <select name="tags" id="tags" class="form-control" onchange="getTags(this.value)">
                                                <option value="">Select</option>';
                                                if(!empty($tags)){
                                                    foreach($tags as $item){
                                                $html.='<option value="{'.$item['tags'].'}">{'.$item['tags'].'}</option>';
                                                    }}
                                              $html .='</select>
                                            </div>       
                                        <input type="hidden" name="type" value="'.$templateData->type.'">
                                        
                                        <div class="col-md-12 mt-3">
                                        <label>Body</label>
                                        <textarea name="body" class="form-control" rows="8" id="editor1"></textarea>
                                    </div>

                                         </div>';
            }

            return response()->json([
                'html'=>$html,
                'subject'=>!empty($getData->subject) ? $getData->subject:$templateData->template_name,
            ]);
        }
    }

    function updateWhatsappTemplate(Request $request)
    {
       
        WhatsappTemplate::updateOrCreate(
            ['template_id' => $request->template_id],
            ['subject' => $request->subject, 
            'body' => $request->body,
            'type'=>$request->type
            ]
        );

        return back()->with('success', 'Template updated!');
    }

   
}
