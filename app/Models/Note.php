<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
	use HasFactory;
	protected $fillable = ['user', 'g_id', 'group', 'font_family', 'font_size', 'line_height', 'main_title', 'secondary_title', 'meta_title', 'slug', 'notes'];

	public function userForNotes()
	{
		return $this->belongsTo(User::class, 'user', 'username');
		// Note::user will receive User::username
	}

	public function groupForNote()
	{
		return $this->belongsTo(Group::class, 'g_id');
	}
}
