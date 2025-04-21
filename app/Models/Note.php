<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = ['user', 'font_family', 'font_size', 'line_height', 'main_title', 'secondary_title', 'meta_title', 'notes'];
}
