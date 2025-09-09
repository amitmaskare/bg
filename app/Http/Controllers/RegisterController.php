<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    
    public function registerUser(Request $request)
    {
        
       
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $fullName = $validated['fname'] . ' ' . $validated['lname'];
        
        User::create([
            'name' => $fullName,
            'email' => $validated['email'],
            'email_verified_at'=>date('Y-m-d H:i:s'),
            'password' => Hash::make($validated['password']),
        ]);

        $template = EmailTemplate::where('type', 'register')->first();
        $trigger=Trigger::find($template->template_id);
        $tags=json_decode($trigger->fields,true);
        $allowed_tags = [];
        foreach ($tags as $item) {
            $allowed_tags[] = '{' . $item['tags'] . '}';
        }

        $template->body = preg_replace_callback('/\{[^\}]+\}/', function ($matches) use ($allowed_tags) {
            return in_array($matches[0], $allowed_tags) ? $matches[0] : '';
        }, $template->body);
    
        $tag_values = [
            '{name}' => $fullName,
            '{email}' => $validated['email']
        ];
    
        $subject = str_replace(array_keys($tag_values), array_values($tag_values), $template->subject);
        $body = str_replace(array_keys($tag_values), array_values($tag_values), $template->body);
    
        Mail::send('emails.template', ['subject' => $subject, 'body' => $body], function ($message) use ($subject, $validated) {
            $message->to($validated['email'])
                    ->subject($subject)
                    ->from('info@brgn.in', 'BRGN');
        });

        return redirect()->back()->with('success', '<h3>Thank you for registration. Please <a href="' . route('authlogin') . '">click here</a> to login.</h3>');

    }
}

?>