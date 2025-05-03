<?php

namespace App\Livewire;

use App\Models\Group;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function Laravel\Prompts\alert;

class EditNote extends Component
{	
	public $id;
	public $slug;

	public $font_family = '';
	public $font_size = '';
	public $line_height = '';

	public $main_title ='';
	public $secondary_title = '';
	public $meta_title = '';
	public $notes = '';

	public $fetchNoteFromDB = '';
	public $username;
	public $g_id = '';
	public $userGroups = [];

	public function mount($id = null, $slug = null)
	{
		$this->id = $id;
		$modifiedSlug = substr($slug, 0, -4);
		$this->slug = $modifiedSlug;
		// dd($id, $slug, $modifiedSlug, $this->slug);
		
		if ($this->slug) {
			$note = Note::where('slug', $this->slug)->where('username', Auth::user()->username)->first();
				if ($note) {
					$this->font_family = $note->font_family;
					$this->font_size = $note->font_size;
					$this->line_height = $note->line_height;
					$this->main_title = $note->main_title;
					$this->secondary_title = $note->secondary_title;
					$this->meta_title = $note->meta_title;
					$this->notes = $note->notes;
					$this->username = $note->user;
					$this->g_id = $note->g_id;
				}
				else{
					// dd("hello");
					abort(403, 'Unauthorized access prevented!');
				}
			}

		$this->username = Auth::user()->username;
		$this->fetchNoteFromDB = Note::where('username', Auth::user()->username)->get();
		$this->userGroups = Group::where('username', $this->username)->get();
	}
	// -------------------------------
	public function updateNote(){

		$validated = $this->validate([
			'font_family' => 'nullable|max:50',
			'font_size' => 'nullable|max:50',
			'line_height' => 'nullable|max:50',
			'g_id' => 'nullable',
			'username' => 'required',
			// -------------
			'main_title' => 'required|max:56',
			'secondary_title' => 'required|nullable|max:60',
			'meta_title' => 'required|max:60',
			'notes' => 'required|max:2000',
		]);

		try {
			// Note::where('slug', $this->slug)->update($validated);
			Note::where('slug', $this->slug)->update([
				 'font_family' => $this->font_family,
				 'font_size' => $this->font_size,
				 'line_height' => $this->line_height,
				 'username' => $this->username,
				 'g_id' => $this->g_id ?: null,
				 'group' => $this->g_id ? Group::where('id', $validated['g_id'])->first()->value('group_name') : null,
				//  ------------
				 'main_title' => $this->main_title,
				 'secondary_title' => $this->secondary_title,
				 'meta_title' => $this->meta_title,
				 'notes' => $this->notes,
			]);
			session()->flash('success', 'Note updated successfully!');
		}catch (\Exception $e) {
			session()->flash('error', 'Failed to update the note. Please try again.');
		}
	}
	// -------------------------------
	public function render()
	{
		$allNotes = $this->fetchNoteFromDB;
		$activeNoteId = $this->id;
		
		return view('livewire.edit-note', compact('allNotes', 'activeNoteId'));
	}
}
