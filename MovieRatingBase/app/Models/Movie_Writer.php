<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_Writer extends Model
{
    use HasFactory;
    protected $table = "movie_writer";

    public function movies()
    {
        return $this->belongsTo(Movie::class, "movie_id");
    }

    public function writer()
    {
        return $this->belongsTo(Writer::class, "writer_id");
    }
}
