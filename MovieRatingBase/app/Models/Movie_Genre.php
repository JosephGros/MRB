<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_Genre extends Model
{
    use HasFactory;
    protected $table = "movie_genre";

    public function movies()
    {
        return $this->belongsTo(Movie::class, "movie_id");
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, "genre_id");
    }
}
