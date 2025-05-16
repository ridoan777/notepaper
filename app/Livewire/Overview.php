<?php

namespace App\Livewire;

use App\Models\Group;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Overview extends Component
{
	public $group_name = '';
	public $user;
	
	// -------------------------------
	public function mount()
	{
		$this->user = Auth::user()->username;
	}
	// -------------------------------
	public function render()
	{		
		$allNotes = Note::where('username', Auth::user()->username)->get();
		$checkNonCategory = Note::where('g_id', null)->where('username', Auth::user()->username)->get();
		$allGroups = Group::where('username', $this->user)->get();

		return view('livewire.overview', compact('allNotes', 'allGroups', 'checkNonCategory'));
	}
}
