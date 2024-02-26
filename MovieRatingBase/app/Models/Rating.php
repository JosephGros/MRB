<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = "ratings";
    protected $fillable = ["rating","user_id", "movie_id", "serie_id", "episode_id"];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function movies()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }

    public function series()
    {
        return $this->belongsTo(Serie::class, 'serie_id');
    }

    public function episode()
    {
        return $this->belongsTo(Episode::class, 'episode_id');
    }
}
