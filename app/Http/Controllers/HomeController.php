<?php

namespace PerfectSenseBlog\Http\Controllers;

/**
 * Controller to handle all requests to the home page.
 *
 * Author:		Mark Conigliaro
 * Version:		1.0 (10-15-2017)
 */
class HomeController extends Controller
{

	// Handles GET requests made to the home route.
	public function getHome()
	{
		return view('pages.home');
	}
}