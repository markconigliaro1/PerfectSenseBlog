<?php

namespace PerfectSenseBlog\Http\Controllers\Auth;

use PerfectSenseBlog\Http\Controllers\Controller;
use PerfectSenseBlog\Models\Post;

use Auth;
use Illuminate\Http\Request;

/**
 * Handles all post related route requests.
 *
 * Author:		Mark Conigliaro
 * Version:		1.0 (10-15-2017)
 */
class PostController extends Controller
{
	/**
	 * Handles POST requests made when posting posts to the database.
	 *
	 * @param request 	The request object passed by the POST request.
	 */
	public function postPost(Request $request)
	{
		// Validate request object parameters.
		$this->validate($request, [
			'post' => 'required'
		]);

		Auth::user()->posts()->create([
			'body' => $request->input('post')
		]);

		return redirect()->route('home')->with('info', 'Post was successful');
	}

}