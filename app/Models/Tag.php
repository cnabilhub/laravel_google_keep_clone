<?php

namespace App\Models;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function notes()
    {
        return $this->belongsToMany(Note::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}