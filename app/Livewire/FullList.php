<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Component;

class FullList extends Component
{
    public function render()
    {
        $allNotes = Note::all();
        return view('livewire.full-list', compact('allNotes'));
    }
}
