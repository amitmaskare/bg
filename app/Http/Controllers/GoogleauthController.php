<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\{User,Employee,EmailTemplate,Trigger};
use Illuminate\Support\Facades\Hash;
class GoogleauthController extends Controller
{
        public function redirectToGoogle(Request $request)
    {
        if ($request->has('redirect_to')) {
            session(['redirect_after_login' => $request->get('redirect_to')]);
        }
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
    
            $user = User::where('email', $googleUser->getEmail())->first();
    
            if (!$user) {
                $user = new User;
                $user->name = $googleUser->getName();
                $user->email = $googleUser->getEmail();
                $user->google_id = $googleUser->getId();
                $user->avatar = $googleUser->getAvatar();
                $user->password = Hash::make(uniqid());
                $user->save();
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
                    '{name}' => $googleUser->getName(),
                    '{email}' => $googleUser->getEmail()
                ];
            
                $subject = str_replace(array_keys($tag_values), array_values($tag_values), $template->subject);
                $body = str_replace(array_keys($tag_values), array_values($tag_values), $template->body);
            
                Mail::send('emails.template', ['subject' => $subject, 'body' => $body], function ($message) use ($subject, $googleUser) {
                    $message->to($googleUser->getEmail())
                            ->subject($subject)
                            ->from('info@brgn.in', 'BRGN');
                });
            }
    
            Auth::login($user);
            $template = EmailTemplate::where('type', 'login')->first();
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
                    '{name}' => $googleUser->getName(),
                    '{email}' => $googleUser->getEmail()
                ];
            
                $subject = str_replace(array_keys($tag_values), array_values($tag_values), $template->subject);
                $body = str_replace(array_keys($tag_values), array_values($tag_values), $template->body);
            
                Mail::send('emails.template', ['subject' => $subject, 'body' => $body], function ($message) use ($subject, $googleUser) {
                    $message->to($googleUser->getEmail())
                            ->subject($subject)
                            ->from('info@brgn.in', 'BRGN');
                });
            $redirectUrl = session('redirect_after_login', url('/'));
            session()->forget('redirect_after_login'); 
    
            return redirect('/')->with('success', 'Login Successful!');
        } catch (\Exception $e) {
            return redirect('/')->with('danger', 'Google login error: ' . $e->getMessage());
        }
    }

}