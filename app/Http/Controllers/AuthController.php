<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

use App\Models\User;

class AuthController extends Controller
{
	/**
     * Display the registration form.
     */
    public function showRegistrationForm(){
        return view("auth.register");
    }

    /**
     * Handle user registration.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // --
		// Define validation rules
        $request->validate([
            'name' => 'required|string|min:8|max:255',
            'email' => [
                'required', 'string', 'email', 'max:255',
                function ($attribute, $value, $fail) {
                    $emailHash = hash('sha256', $value);
                    if (User::where('email_hash', $emailHash)->exists()) {
                        $fail('The email has already been taken.');
                    }
                },
            ],
            'password' => 'required|min:8|confirmed',
            'role' => 'required|integer|in:1,2' // 1 = organizer, 2 = attendee
        ]);
        
        // Encrypt email and name before saving to database
        $data = $request->all();
        $user = User::create($data);

        if($user) {
            // --
            // Redirect to events page with success message
            return redirect()->route('events.index')->with('success', \Lang::get('messages.user_login_success'));
        } else {
            return redirect()->back()->withInput()->with('error', 'Registration failed.');
        }
    }

    /**
     * Display the login form.
     */
    public function loginForm()
    {
        return view("auth.login");
    }

    /**
     * Handle user login.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        $user = User::where('email_hash', hash('sha256', $credentials['email']))->first();

        if ($user && $user->email === $credentials['email'] && \Auth::attempt($credentials)) {
            \Cache::forget('events_list');
            return redirect()->route('homepage')->with('success', \Lang::get('messages.user_login_success'));
        } else {
            return redirect()->back()->withInput()->with('error', 'Invalid credentials');
        }
    }

    /**
     * Handle user logout.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request) {
        \Auth::logout();
        
        return redirect()->route('login-form')->with('success', \Lang::get('messages.logout'));
    }
}