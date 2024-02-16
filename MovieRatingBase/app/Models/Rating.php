<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = "ratings";
    protected $fillable = ["user_id", "movie_id", "serie_id", "episode_id"];

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }

    public function series()
    {
        return $this->belongsTo(Serie::class);
    }

    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }
}
