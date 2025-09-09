<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\{User,Employee};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{
        public function register()
        {
            $data['title']='Register';
            $data['heading']='Register';
            return view('register',compact('data'));
        }

         public function saveRegister(Request $request)
     {
         
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
             'phone_number' => 'required|string|max:15|unique:users,phone_number',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $fullName = $validated['fname'] . ' ' . $validated['lname'];
        
        User::create([
            'name' => $fullName,
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
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

        public function authlogin()
        {
            $data['title']='Login';
            $data['heading']='Login';
            return view('login',compact('data')); 
        }

        public function loginuser(Request $request)
        {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
           if (Auth::attempt($credentials)) {
            $template = EmailTemplate::where('type', 'login')->first();
        $trigger = Trigger::find($template->template_id);
        $tags    = json_decode($trigger->fields, true);

        $allowed_tags = [];
        foreach ($tags as $item) {
            $allowed_tags[] = '{' . $item['tags'] . '}';
        }

        $template->body = preg_replace_callback('/\{[^\}]+\}/', function ($matches) use ($allowed_tags) {
            return in_array($matches[0], $allowed_tags) ? $matches[0] : '';
        }, $template->body);

        $user = \DB::table('users')->where('email', $credentials['email'])->first();
        $fullName = $user->name ?? 'User';

        $tag_values = [
            '{name}'  => $fullName,
            '{email}' => $credentials['email'],
        ];

        $subject = str_replace(array_keys($tag_values), array_values($tag_values), $template->subject);
        $body    = str_replace(array_keys($tag_values), array_values($tag_values), $template->body);

        Mail::send('emails.template', ['subject' => $subject, 'body' => $body], function ($message) use ($subject, $credentials) {
            $message->to($credentials['email'])
                    ->subject($subject)
                    ->from('info@brgn.in', 'BRGN');
        });
                $request->session()->regenerate();
                return redirect()->route('/');
            }
            return back()->with('error', 'Incorrect email or password.');
        }

        public function logout(Request $request)
            {
                 $user = Auth::user();

    if ($user) {
        $template = EmailTemplate::where('type', 'logout')->first();

        if ($template) {
            $trigger = Trigger::find($template->template_id);
            $tags    = json_decode($trigger->fields, true);

            $allowed_tags = [];
            foreach ($tags as $item) {
                $allowed_tags[] = '{' . $item['tags'] . '}';
            }

            $template->body = preg_replace_callback('/\{[^\}]+\}/', function ($matches) use ($allowed_tags) {
                return in_array($matches[0], $allowed_tags) ? $matches[0] : '';
            }, $template->body);

            $tag_values = [
                '{name}'  => $user->name ?? 'User',
                '{email}' => $user->email,
            ];

            $subject = str_replace(array_keys($tag_values), array_values($tag_values), $template->subject);
            $body    = str_replace(array_keys($tag_values), array_values($tag_values), $template->body);

            Mail::send('emails.template', ['subject' => $subject, 'body' => $body], function ($message) use ($user, $subject) {
                $message->to($user->email)
                        ->subject($subject)
                        ->from('info@brgn.in', 'BRGN');
            });
        }
    }
                Auth::logout(); // Logs out the user

                $request->session()->invalidate(); // Clears session data
                $request->session()->regenerateToken(); // Regenerates CSRF token
                

                return redirect()->route('authlogin');
            }

}
