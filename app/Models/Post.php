<?php

namespace PerfectSenseBlog\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * The model for the Posts table within the database.
 *
 * Author:		Mark Conigliaro
 * Version:		1.0 (10-15-2017)
 */
class Post extends Model
{
	// The name of the table within the database.
	protected $table = 'posts';

	// The fillable columns within the database.
	protected $fillable = [
		'body'
	];

	public function getPostTime()
	{
		$timestamp = new DateTime($this->created_at);
		return $timestamp->format("F j, Y \a\\t g:i A");
	}

	/**
	 * Relational function to retrieve the user table entry for this post.
	 */
	public function user()
	{
		return $this->belongsTo('PerfectSenseBlog\Models\User', 'user_id');
	}

}