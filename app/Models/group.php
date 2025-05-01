<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	use HasFactory;
	protected $fillable = ['group_name', 'user_id', 'username'];
	
	public function userForGroups()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}


