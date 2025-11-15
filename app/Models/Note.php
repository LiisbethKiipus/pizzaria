<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\NoteFactory;

class Note extends Model
{
    /** @use HasFactory<NoteFactory> */
    use HasFactory;
    protected $fillable = ['note', 'user_id'];
}
