<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_Creator extends Model
{
    use HasFactory;
    protected $table = "movie_creator";

    public function movies()
    {
        return $this->belongsTo(Movie::class, "movie_id");
    }

    public function creator()
    {
        return $this->belongsTo(Creator::class, "creator_id");
    }
}
