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

        return redirect()->back()->with('success', '<h3>Thank you for registration. Please <a href="' . route('authlogin') . '">click here</a> to login.</h3>');

    }
}

?>