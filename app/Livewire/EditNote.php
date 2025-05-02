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
	public $userGroups = [];

	public function mount($id = null, $slug = null)
	{
		$this->id = $id;
		$modifiedSlug = substr($slug, 0, -4);
		$this->slug = $modifiedSlug;
		// dd($id, $slug, $modifiedSlug, $this->slug);
		
		if ($this->slug) {
			$note = Note::where('slug', $this->slug)->where('user', Auth::user()->username)->first();
				if ($note) {
					$this->font_family = $note->font_family;
					$this->font_size = $note->font_size;
					$this->line_height = $note->line_height;
					$this->main_title = $note->main_title;
					$this->secondary_title = $note->secondary_title;
					$this->meta_title = $note->meta_title;
					$this->notes = $note->notes;
				}
				else{
					// dd("hello");
					abort(403, 'Unauthorized access prevented!');
				}
			}

		$this->username = Auth::user()->username;
		$this->fetchNoteFromDB = Note::where('user', Auth::user()->username)->get();
		$this->userGroups = Group::where('username', $this->username)->get();
	}
	// -------------------------------
	public function updateNote(){

		$validated = $this->validate([
			'font_family' => 'max:50',
			'font_size' => 'max:50',
			'line_height' => 'max:50',
			'main_title' => 'required|max:56',
			'secondary_title' => 'required|nullable|max:60',
			'notes' => 'required|max:2000',
			'meta_title' => 'required|max:60',
			'username' => 'required',
		]);

		try {
			Note::where('id', $this->id)->update([
				 'font_family' => $this->font_family,
				 'font_size' => $this->font_size,
				 'line_height' => $this->line_height,
				//  ------------
				 'main_title' => $this->main_title,
				 'secondary_title' => $this->secondary_title,
				 'meta_title' => $this->meta_title,
				 'notes' => $this->notes
			]);
 
			session()->flash('success', 'Note updated successfully!');
	  } catch (\Exception $e) {
			session()->flash('error', 'Failed to update the note. Please try again.');
	  }
	}
	// -------------------------------
	public function delete($id = null, $slug = null)
	{
		// $noteId = $id ?? $this->id;
		$modifiedSlug = substr($slug, 0, -4);
		$this->slug = $modifiedSlug;
		dd("before", $slug);
		try {
			$note = Note::where('slug', $this->slug)->where('user', Auth::user()->username)->first();
			dd($note);
			$note->delete();
			session()->flash('success', 'Note deleted successfully!');
			return redirect()->route('dashboard');
		} 
		catch (\Exception $e) {
			session()->flash('error', 'Failed to delete the note. Please try again.');
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
