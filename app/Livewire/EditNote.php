<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Component;

class EditNote extends Component
{	
	public $id;

	public $font_family = '';
	public $font_size = '';
	public $line_height = '';

	public $main_title ='';
	public $secondary_title = '';
	public $meta_title = '';
	public $notes = '';

	public $fetchNoteFromDB = '';
	
	public function mount($id = null)
	{
		// $this->id = $id;
		if ($id) {
			$note = Note::find($id);
				if ($note) {
					$this->font_family = $note->font_family;
					$this->font_size = $note->font_size;
					$this->line_height = $note->line_height;
					$this->main_title = $note->main_title;
					$this->secondary_title = $note->secondary_title;
					$this->meta_title = $note->meta_title;
					$this->notes = $note->notes;
				}
			}
		$this->fetchNoteFromDB = Note::all();
		
	}
	// -------------------------------
	public function updateNote(){
		// dd("updating = ", $this->font_family, $this->main_title);
		try {
			// dd("in try");
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
 
			session()->flash('message', 'Note updated successfully!');
	  } catch (\Exception $e) {
		dd("error part");
			session()->flash('error', 'Failed to update the note. Please try again.');
	  }
	}
	// -------------------------------
	public function render()
	{
		$allNotes = $this->fetchNoteFromDB;
		return view('livewire.edit-note', compact('allNotes'));
	}
}
