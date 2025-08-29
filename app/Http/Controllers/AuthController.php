<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\{User,Employee};
use Illuminate\Support\Facades\Hash;
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
                $request->session()->regenerate();
                return redirect()->route('/');
            }
            return back()->with('error', 'Incorrect email or password.');
        }

        public function logout(Request $request)
            {
                Auth::logout(); // Logs out the user

                $request->session()->invalidate(); // Clears session data
                $request->session()->regenerateToken(); // Regenerates CSRF token

                return redirect()->route('authlogin');
            }

}
