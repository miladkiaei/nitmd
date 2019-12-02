<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = [
        'phrase', 'example', 'meaning', 'meaning_fa'
    ];


    public function segments()
    {
        return $this->hasMany(EntrySegment::class);
    }
}
