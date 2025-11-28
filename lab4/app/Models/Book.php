<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'author',
        'year',
        'isbn',
        'genre',
        'borrowed_by',
        'borrow_date',
        'return_date'
    ];
}
