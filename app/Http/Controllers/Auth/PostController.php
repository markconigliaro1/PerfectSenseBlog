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

	/**
	 * Handles POST requests made when posting comments to the database.
	 *
	 * @param request 	The request object passed by the POST request.
	 * @param postID 	The post ID to comment to.
	 */
	public function postComment(Request $request, $postID)
	{
		// Validate request object parameters.
		$this->validate($request, [
			"comment-{$postID}" => 'required'
		], [
			'required' => 'The comment field is require.'
		]);

		// Check for a valid post.
		$post = Post::notComment()->find($postID);
		if (!$post) { return redirect()->route('home'); }

		// Creates a comment and associates with the user and post.
		$comment = Post::create([
			'body' => $request->input("comment-{$postID}")
		])->user()->associate(Auth::user());
		$post->comments()->save($comment);

		return redirect()->back();
	}

	/**
	 * Handles GET requests made when liking likeables.
	 *
	 * @param postID 	The post ID to like to.
	 */
	public function getLike($postID)
	{
		// Check for valid post.
		$post = Post::find($postID);
		if (!$post) { return redirect()->route('home'); }

		// Check if post is already liked.
		if (Auth::user()->hasLikedPost($post))
		{
			return redirect()->back();
		}

		// Associate like with the post and user.
		$like = $post->likes()->create([]);
		Auth::user()->likes()->save($like);

		return redirect()->back();
	}

}