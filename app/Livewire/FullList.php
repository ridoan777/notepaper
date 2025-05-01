<?php

namespace App\Livewire;

use App\Models\Group;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FullList extends Component
{
	public $group_name = '';
	public $user;
	
	// -------------------------------
	public function mount()
	{
		$this->user = Auth::user();
	}
	// -------------------------------
	public function createGroup(){

		$validated = $this->validate([
			'group_name' => 'required|max:30',
		]);
		
		// $user = Auth::user();

		try {
			$var = Group::create([
				'group_name' => $this->group_name,
				'user_id' => $this->user->id,
				'username' => $this->user->username,
			]);

			session()->flash('success', 'Group created successfully!');
			return redirect('/');
	  	} catch (\Exception $e) {
			session()->flash('error', 'Failed to create the group. Please try again.');
	  	}
	}
	// --------------------------
	public function render()
	{
		$allNotes = Note::where('user', Auth::user()->username)->get();
		$allGroups = Group::where('username', $this->user->username)->get();
		return view('livewire.full-list', compact('allNotes', 'allGroups'));
	}
}
