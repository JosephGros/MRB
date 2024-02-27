<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;
    protected $table = "series";
    protected $fillable = ["name", "poster", "release", "end", "runtime", "description", "trailer"];


    public function watchlists()
    {
        return $this->morphMany(Watchlist::class, 'media');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function directors()
    {
        return $this->belongsToMany(Director::class);
    }

    public function writers()
    {
        return $this->belongsToMany(Writer::class);
    }

    public function creators()
    {
        return $this->belongsToMany(Creator::class);
    }
}
