<?php

namespace App\Http\Controllers;

use App\Models\User;
use Coderflex\LaravelTurnstile\Rules\TurnstileCheck;
use Coderflex\LaravelTurnstile\Facades\LaravelTurnstile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
	public function viewRegister()
	{
		return view('components.auth.register');
	}
	// ----------------
	public function viewLogin()
	{
		return view('components.auth.login');
	}
	// ----------------
	public function storeRegister(Request $request)
	{
		$validated = $request->validate([
			'name' => 'required|string|max:64',
			'username' => 'required|string|max:255|unique:users',
			'email' => 'required|email|max:56|unique:users',
			'password' => 'required|string|min:4|confirmed', //use 1234
			'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:512',
			'terms' => 'required|in:true',
			'cf-turnstile-response' => ['required', new TurnstileCheck()],
		], [
			'name.required' => 'Please Enter Your Name!',
			'name.max' => 'Name should be maximum 64 characters!',
			'image.mimes' => 'Allowed image formats: "jpeg, png, jpg, gif, webp" only',
			'image.max' => 'Image size must be less than 512KB.',
			"cf-turnstile-response.required" => "The CAPTCHA thinks you are a robot! Please refresh and try again."
		]);
		
		if ($request->hasFile('image'))
		{
			$image = $request->file('image');

			$originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

			$sanitized = preg_replace('/\s+/', '_', $originalName);

			$trimmedName = substr($sanitized, 0, 10);
	  
			$imageName = $trimmedName . '_' . substr(time(), -4) . '.' . $image->getClientOriginalExtension();

			$image->storeAs('user_files', $imageName, 'public');

			$validated['image'] = 'storage/user_files/' . $imageName;
		}
		
		User::create($validated);

		return redirect()->route('login')->with('success', "Registered successfully!");
	}
	// ----------------
	public function storeLogin(Request $request)
	{
		$validated = $request->validate([
			'emailOrUsername' => 'required|string',
			'password' => 'required|string', //use 1234
			'cf-turnstile-response' => ['required', new TurnstileCheck()],
		],[
			"cf-turnstile-response.required" => "CAPTCHA Error! The CAPTCHA thinks you are a robot! Please refresh and try again."
		]);
		
		$loginInput = $request->input('emailOrUsername');
		$loginField = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
	  
		// First, check if the user exists
		$user = ($loginField === 'email') 
			? User::where('email', $loginInput)->first() 
			: User::where('username', $loginInput)->first();
		
		// If user doesn't exist, only show email/username error
		if (!$user) {
			throw ValidationException::withMessages([
				'emailOrUsername' => 'Sorry, incorrect email/username'
			]);
		}
		
		// Now try to authenticate with the password
		if (Auth::attempt([
			  $loginField => $loginInput,
			  'password' => $validated['password']
		])) {
			$request->session()->regenerate();
			return redirect()->route('dashboard')->with('success', "Logged in successfully!");
		}
		
		// If authentication failed at this point, it's definitely the password
		throw ValidationException::withMessages([
			'password' => 'Sorry, incorrect password'
		]);
	}
	// ----------------
	public function logout(Request $request)
	{
		Auth::logout(); //will clear user data from session but products, whishlist items, etc.

		$request->session()->invalidate(); //to clear remaining session data
		$request->session()->regenerateToken(); //generates csrf token. Anything submitted with previous tokens will be rejected.

		return redirect()->route('login');
	}
	// ----------------
	public function emailAvaibalityCheck(Request $request)
	{
		if ($request->get('email')) {
			$email = $request->get('email');
			$data = User::where('email', $email)->count();

			if ($data > 0) {
				return response()->json(['status' => 'not_unique']);
			} else {
				return response()->json(['status' => 'unique']);
			}
		}
	}
	// ----------------
	public function usernameAvaibalityCheck(Request $request)
	{
		if ($request->get('username')) {
			$username = $request->get('username');
			$data = User::where('username', $username)->count();

			if ($data > 0) {
				return response()->json(['status' => 'not_unique']);
			} else {
				return response()->json(['status' => 'unique']);
			}
		}
	}
	// ----------------

	// ----------------
}
