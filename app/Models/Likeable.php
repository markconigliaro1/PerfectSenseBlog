<?php

namespace PerfectSenseBlog\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The model for the Likeable table within the database.
 *
 * Author:		Mark Conigliaro
 * Version:		1.0 (10-15-2017)
 */
class Likeable extends Model
{
	// The name of the table within the database.
	protected $table = 'likeable';

	// The fillable columns within the database.
	protected $fillable = [
		'body'
	];

	/**
	 * Polymorphic relational function to retrieve the comments for this likeable.
	 */
	public function likeable()
	{
		return $this->morphTo();
	}

	/**
	 * Relational function to retrieve the user for this likeable.
	 */
	public function user()
	{
		return $this->belongsTo('PerfectSenseBlog\Models\User', 'user_id');
	}

}