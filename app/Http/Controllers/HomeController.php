<?php

namespace PerfectSenseBlog\Http\Controllers;

use Auth;
use PerfectSenseBlog\Models\Post;

/**
 * Controller to handle all requests to the home page.
 *
 * Author:		Mark Conigliaro
 * Version:		1.0 (10-15-2017)
 */
class HomeController extends Controller
{
	/**
	 * Handles GET requests made to the home route.
	 */ 
	public function getHome()
	{
		// Return the timeline page instead of the default home page if the user is signed in.
		if (Auth::check())
		{
			$posts = Post::notComment()->latest()->paginate(20);
			$user = Auth::user();
			return view('pages.auth.timeline')->with('posts', $posts)->with('user', $user);
		}

		return redirect()->route('guest.signup');
	}
}