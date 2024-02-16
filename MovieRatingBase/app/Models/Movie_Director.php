<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_Director extends Model
{
    use HasFactory;
    protected $table = "movie_director";

    public function movies()
    {
        return $this->belongsTo(Movie::class, "movie_id");
    }

    public function director()
    {
        return $this->belongsTo(Director::class, "director_id");
    }
}
