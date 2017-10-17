<?php

namespace PerfectSenseBlog\Http\Controllers\Guest;

use PerfectSenseBlog\Http\Controllers\Controller;
use PerfectSenseBlog\Models\User;

use Auth;
use Illuminate\Http\Request;

/**
 * Handles all guest-only route requests including the sign up page 
 * and the login page.
 *
 * Author:		Mark Conigliaro
 * Version:		1.0 (10-15-2017)
 */
class GuestController extends Controller
{
	/**
	 * Handles GET requests made to the signup route.
	 */
	public function getSignUp()
	{
		return view('pages.guest.signup');
	}

	/**
	 * Handles POST requests made to the signup route.
	 *
	 * @param request 	The request object passed by the POST request.
	 */
	public function postSignUp(Request $request)
	{

		// Validate the request parameters.
		$this->validate($request, [
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'username' => 'required|unique:users|alpha_dash|max:20',
			'email' => 'required|unique:users|email|max:255',
			'password' => 'required|min:6',
			'confirm_password' => 'required|same:password'
		]);

		// Create the account.
		User::create([
			'first_name' => $request->input('first_name'),
			'last_name' => $request->input('last_name'),
			'username' => $request->input('username'),
			'email' => $request->input('email'),
			'password' => bcrypt($request->input('password'))
		]);

		// Redirect home with confirmation.
		return redirect()->route('home')->with('success', 'Your account has been successfully created!');
	}

	/**
	 * Handles GET requests made to the signin route.
	 */
	public function getSignIn()
	{
		return view('pages.guest.signin');
	}

	/**
	 * Handles POST requests made to the signin route.
	 *
	 * @param request 	The request object passed by POST request.
	 */
	public function postSignIn(Request $request)
	{

		// Validate the request parameters.
		$this->validate($request, [
			'email' => 'required',
			'password' => 'required'
		]);

		// Attempts to sign the user in and create an authenticated session.
		if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember')))
		{
			return redirect()->back()->with('danger', 'Invalid email or password. Please try again.');
		}

		// Redirect the user back to the home page signed in.
		return redirect()->route('auth.profile.index', ['username' => Auth::user()->username])
		->with('success', 'You have been successfully signed in.');
	}
}