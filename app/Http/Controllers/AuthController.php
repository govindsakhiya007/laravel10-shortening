<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

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
        $rules = [
            'name' => 'required|string|min:8|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ];
        
        // --
		// Define custom validation messages
        $messages = [
            'name.required' => Lang::get('validations.login_form.name.required'),
            'name.min' => Lang::get('validations.login_form.minlength.required'),
            'name.max' => Lang::get('validations.login_form.maxlength.required'),
            'email.required' => Lang::get('validations.email_required'),
            'email.email' => Lang::get('validations.email_email'),
            'password.required' => Lang::get('validations.password_required'),
            'password.min' => Lang::get('validations.password_minlength'),
            'password_confirmation.same' => Lang::get('validations.password_confirm')
        ];
        
        // --
		// Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // --
		// Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // --
		// Redirect to login form with success message
        return redirect()->route('login-form')->with('success', Lang::get('messages.register_success'));
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
        $input = $request->all();

        // --
		// Define validation rules
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        
        // --
		// Define custom validation messages
        $messages = [
            'email.required' => Lang::get('validations.email_required'),
            'email.email' => Lang::get('validations.email_email'),
            'password.required' => Lang::get('validations.password_required')
        ];

        // --
		// Validate the request
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // --
		// Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('urls.index')->with('success', Lang::get('messages.user_login_success'));
        }

        // --
		// If login fails, redirect back with error message
        return back()->with('error', 'Invalid credentials.');
    }

    /**
     * Handle user logout.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('login-form')->with('success', Lang::get('messages.logout'));
    }
}