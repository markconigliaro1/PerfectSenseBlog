<?php

namespace PerfectSenseBlog\Http\Controllers\Auth;

use PerfectSenseBlog\Http\Controllers\Controller;
use PerfectSenseBlog\Models\User;

use Auth;
use Illuminate\Http\Request;

/**
 * Handles all auth-only route requests.
 *
 * Author:		Mark Conigliaro
 * Version:		1.0 (10-15-2017)
 */
class AuthController extends Controller
{
	/**
	 * Handles GET requests made to the signout route.
	 */
	public function getSignOut()
	{
		// Log the user out.
		Auth::logout();

		// Redirect the user back to the home page.
		return redirect()->route('home')->with('success', 'You have been successfully signed out');
	}

}