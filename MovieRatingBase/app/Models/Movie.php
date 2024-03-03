<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $table = "movies";
    protected $fillable = ["name", "poster", "release", "runtime", "description", "trailer"];

    public function watchlists()
    {
        return $this->hasMany(Watchlist::class, 'movie_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class,'movie_genre', 'movie_id', 'genre_id');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'movie_actor');
    }

    public function directors()
    {
        return $this->belongsToMany(Director::class, 'movie_director');
    }

    public function writers()
    {
        return $this->belongsToMany(Writer::class, 'movie_writer');
    }

    public function creators()
    {
        return $this->belongsToMany(Creator::class, 'movie_creator');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
