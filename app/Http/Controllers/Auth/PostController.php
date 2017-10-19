<?php

namespace PerfectSenseBlog\Http\Controllers\Auth;

use PerfectSenseBlog\Http\Controllers\Controller;
use PerfectSenseBlog\Models\Post;
use PerfectSenseBlog\Models\Likeable;

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
			'title' => 'required|max:100',
			'body' => 'required'
		]);

		Auth::user()->posts()->create([
			'title' => $request->input('title'),
			'body' => $request->input('body')
		]);

		return redirect()->back()->with('info', 'Post was successful.');
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

	/**
	 * Handles GET requests made when liking likeables.
	 *
	 * @param postID 	The post ID to like to.
	 */
	public function getUnlike($postID)
	{
		// Check for valid post.
		$post = Post::find($postID);
		if (!$post) { return redirect()->route('home'); }

		// Check if post isn't already liked.
		if (!Auth::user()->hasLikedPost($post))
		{
			return redirect()->back();
		}

		// Unlike the post.
		$like = Likeable::where('user_id', Auth::user()->id)
		->where('likeable_id', $postID)
		->delete();

		return redirect()->back();
	}

	/**
	 * Handles GET requests made when liking likeables.
	 *
	 * @param postID 	The post ID to like to.
	 */
	public function getDelete($postID)
	{
		// Check for valid post.
		$post = Post::find($postID);
		if (!$post) { return redirect()->route('home'); }

		// Verify the post can be deleted by this user.
		if (Auth::user()->id != $post->user->id)
		{
			return redirect()->back();
		}

		// Delete the post and associated comments.
		$post->delete();
		Post::where('parent_id', $post->id)->delete();

		return redirect()->back()->with('info', 'Post was successfully deleted.');
	}

}