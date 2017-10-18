<?php

namespace PerfectSenseBlog\Http\Controllers\Auth;

use PerfectSenseBlog\Http\Controllers\Controller;
use PerfectSenseBlog\Models\User;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Controller to handle all profile related requests.
 *
 * Author:		Mark Conigliaro
 * Version:		1.0 (10-15-2017)
 */
class ProfileController extends Controller
{
	/**
	 * Handles GET requests made to the profile page route.
	 */
	public function getProfile($username)
	{	
		// Check for a valid user.
		$user = User::where('username', $username)->first();
		if (!$user) { abort(404); }

		// Retrieve all of the user's posts.
		$posts = $user->posts()->notComment()->latest()->paginate(20);
			
		return view('pages.auth.profile.index')
		->with('user', $user)
		->with('posts', $posts);
	}

	/**
	 * Handles GET requests made to the profile settings route.
	 */
	public function getProfileSettings()
	{
		return view('pages.auth.profile.settings');
	}

	/**
	 * Handles POST requests made to the profile settings route.
	 *
	 * @param request 	The request object passed by the POST request.
	 */
	public function postProfileSettings(Request $request)
	{
		// Validate the request parameters.
		$this->validate($request, [
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'username' => [
				'required',
				'alpha_dash',
				'max:20',
				Rule::unique('users')->ignore(Auth::user()->id)
			],
			'email' => [
				'required', 
				Rule::unique('users')->ignore(Auth::user()->id)
			],
			'location' => 'max:100'
		]);

		Auth::user()->update([
			'first_name' => $request->input('first_name'),
			'last_name' => $request->input('last_name'),
			'username' => $request->input('username'),
			'email' => $request->input('email'),
			'location' => $request->input('location')
		]);

		return redirect()->route('auth.profile.settings', ['username' => Auth::user()->username])
		->with('info', 'Your profile has been updated.');
	}
}