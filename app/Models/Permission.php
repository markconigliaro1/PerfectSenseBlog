<?php

namespace PerfectSenseBlog\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The model for the Permissions table within the database.
 *
 * Author:		Mark Conigliaro
 * Version:		1.0 (10-15-2017)
 */
class Permission extends Model
{
	// The name of the table within the database.
	protected $table = 'permissions';

	// The fillable columns within the database.
	protected $fillable = [
		'can_post',
		'can_comment',
	];

	/**
	 * Relational function to retrieve the user table entry for this permission set.
	 */
	public function user()
	{
		return $this->belongsTo('PerfectSenseBlog\Models\User', 'user_id');
	}

}