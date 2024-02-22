<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_Actor extends Model
{
    use HasFactory;
    protected $table = "movie_actor";
    protected $fillable = ["role"];

    public function movies()
    {
        return $this->belongsTo(Movie::class, "movie_id");
    }

    public function actor()
    {
        return $this->belongsTo(Actor::class, "actor_id");
    }
}
