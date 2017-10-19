<?php

namespace PerfectSenseBlog\Models;

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
		'title',
		'body'
	];

	/**
	 * Relational function to retrieve the user table entry for this post.
	 */
	public function user()
	{
		return $this->belongsTo('PerfectSenseBlog\Models\User', 'user_id');
	}

	/**
	 * Relational function to retrieve the comments for this post.
	 */
	public function comments()
	{
		return $this->hasMany('PerfectSenseBlog\Models\Post', 'parent_id');
	}

	/**
	 * Polymorphic relational function to retrieve the likes for this post.
	 */
	public function likes()
	{
		return $this->morphMany('PerfectSenseBlog\Models\Likeable', 'likeable');
	}

	/**
	 * Retrieves all posts that are the highest parent.
	 */
	public function scopeNotComment($query)
	{
		return $query->whereNull('parent_id');
	}

}