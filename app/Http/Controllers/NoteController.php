<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
	public function deleteNote($slug){
		$modifiedSlug = substr($slug, 0, -4);
		
		try {
			$note = Note::where('slug', $modifiedSlug)->where('username', Auth::user()->username)->first();
			$title = $note->main_title;
			$note->delete();

			session()->flash('success', 'Note "' . $title . '" deleted successfully!');
			return redirect()->route('dashboard');
		}
		catch (\Error $e) {
			abort(403, "Unauthorized access prevented! \n You can only try but continuous attempts of trespassing might result in account termination!");
	  	}
		catch (\Exception $e) {
			session()->flash('error', 'Failed to delete the note. Please try again.');
		}
	
	}
}