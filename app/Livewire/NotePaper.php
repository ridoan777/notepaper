<?php

namespace App\Livewire;

use App\Models\Group;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class NotePaper extends Component
{
	// public $user = '';

	public $font_family = '';
	public $font_size = '';
	public $line_height = '';
	
	public $main_title ='';
	public $secondary_title = '';
	public $meta_title = '';
	public $notes = '';

	public $g_id;
	public $group = '';
	public $userGroups = [];

	public $username;
	public $cf_token;


	// -------------------------------
	public function mount()
	{
		$this->username = Auth::user()->username;
		$this->userGroups = Group::where('username', $this->username)->get();
	}
	// -------------------------------
	public function createNote(){

		$validated = $this->validate([
			'font_family' => 'max:50',
			'font_size' => 'max:50',
			'line_height' => 'max:50',
			'g_id' => 'nullable|max:50',
			'group' => 'nullable|max:32',
			'username' => 'required',
			// ------------
			'main_title' => 'required|max:56',
			'secondary_title' => 'required|max:60',
			'notes' => 'required|max:2000',
			'meta_title' => 'nullable',
		]);
		// dd($validated['g_id']);
			
		$slug = Str::slug(Str::words($this->main_title, 2, ''), '-') . '%' . Auth::id() . 'n' . substr(time(), -4);

		if($validated['g_id'] != null){
			$this->group = Group::where('id', $this->g_id)->first()->group_name;
		}
		else{
			$this->group = "uncategorized";
		}
		// dd($this->g_id, $this->group);
		try {
			$var = Note::create([
				'username' => $this->username,
				'main_title' => $this->main_title,
				'g_id' => $this->g_id ?: null,
				// 'group' => $this->group ?: null,
				'group' => $this->group,
				'slug' => $slug,
				'font_family' => $this->font_family,
				'font_size' => $this->font_size,
				'line_height' => $this->line_height,
				// --------------------------
				'meta_title' => $this->meta_title,
				'secondary_title' => $this->secondary_title,
				'notes' => $this->notes,
			]);

			session()->flash('success', 'Note created successfully!');
			return redirect()->route('dashboard');
		}
		catch (\Exception $e) {
				session()->flash('error', 'Failed to create the note. Please try again.');
				logger()->error('Note creation failed: ' . $e->getMessage());
				$this->addError('create_note_error', $e->getMessage());
		}
	}

	// -------------------------------
	public function render()
	{
		return view('livewire.note-paper');
	}
}
