<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $table = "movies";
    protected $fillable = ["name", "poster", "release", "runtime", "description"];

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
