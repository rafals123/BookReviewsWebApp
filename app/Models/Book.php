<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'bookTitle',
        'authorName',
        'authorSurname',
        'releaseDate',
        'genre',
        'numOfRecommended',
        'numOfNotRecommended',
    ];

    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
