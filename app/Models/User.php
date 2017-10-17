<?php

namespace PerfectSenseBlog\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

/**
 * The model for the Users table within the database.
 *
 * Author:		Mark Conigliaro
 * Version:		1.0 (10-15-2017)
 */
class User extends Model implements AuthenticatableContract
{
	use Authenticatable;

	// The name of the table within the database.
	protected $table = 'users';

	// The fillable columns within the database.
	protected $fillable = [
		'first_name', 
		'last_name', 
		'username', 
		'email', 
		'password',
		'location'
	];

	// The hidden columns from the JSON output.
	protected $hidden = [
		'password',
		'remember_token'
	];

	/**
	 * Returns the user's full name (first + last name).
	 */
	public function getFullName()
	{

		// Users cannot sign up without their full name. The conditional is precautionary.
		if ($this->first_name && $this->last_name) 
		{
			return "{$this->first_name} {$this->last_name}";
		}

		// For whatever reason the user does not have a full name, return the username.
		return "{$this->username}";
	}

}