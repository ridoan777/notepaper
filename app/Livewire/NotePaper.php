<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Component;

class NotePaper extends Component
{
	public $user = '';

	public $font_family = '';
	public $font_size = '';
	public $line_height = '';
	
	public $main_title ='';
	public $secondary_title = '';
	public $meta_title = '';
	public $notes = '';

	public function createNote(){

		try {
			$validated = $this->validate([
				'user' => 'required|max:50',
				'font_family' => 'max:50',
				'font_size' => 'max:50',
				'line_height' => 'max:50',
				'main_title' => 'required|max:56',
				'secondary_title' => 'required|max:60',
				'notes' => 'required|max:2000',
				'meta_title' => 'required|max:60',
			]);
			
			// dd("validated = ", $validated);
			$var = Note::create([
				'user' => $this->user,
				'font_family' => $this->font_family,
				'font_size' => $this->font_size,
				'line_height' => $this->line_height,
				'main_title' => $this->main_title,
				'secondary_title' => $this->secondary_title,
				'notes' => $this->notes,
				'meta_title' => $this->meta_title,
			]);

			session()->flash('message', 'Note created successfully!');
		} catch (\Illuminate\Validation\ValidationException $e) {
			session()->flash('errors', $e->errors());
		} catch (\Exception $e) {
			session()->flash('error', $e->getMessage());
		}
		// $this->reset();
	}


	// -------------------------------
	public function render()
	{
		return view('livewire.note-paper');
	}
}
