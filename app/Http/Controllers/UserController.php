<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('registration');
    }
    //end


    public function register(Request $request)
   {
    // Validate the user input
    $request->validate([
        'name' => 'required|string|min:3|max:10|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:3|max:8',
    ]);

    // Create a new user
    $user = new User([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
    ]);

 // Save the user to the database
   $user->save();

    // Redirect to the registration form with a success message
    return redirect('/registration')->with('status', 'Registration successful! Please log in.');
   }
   //end

   public function showLoginForm()
    {
        return view('login');
    }//end
    
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('/dashboard')->with('status', 'Login successful! Welcome to the dashboard.');
        }

        return redirect('/login')->with('error', 'Invalid credentials. Please try again.');
    }//end

    public function logout()
    {
        Auth::logout();
        Session()->flush();

        return redirect('/login')->with('status', 'Logout successful!');
    }//end




}
