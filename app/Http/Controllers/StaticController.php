<?php

namespace PerfectSenseBlog\Http\Controllers;

/**
 * Controller that handles all requests made to static pages on the site.
 *
 * Author:		Mark Conigliaro
 * Version:		1.0 (10-15-2017)
 */
class StaticController extends Controller
{

	/**
	 * Handles GET requests made to the 'home' route.
	 */
	public function getHome()
	{
		return view('pages.home');
	}
}