<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $table = "genres";
    protected $fillable = ['name'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }

    public function series()
    {
        return $this->belongsToMany(Serie::class);
    }
}
