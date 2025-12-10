<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'date',
        'organizer_id',
    ];
    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}
