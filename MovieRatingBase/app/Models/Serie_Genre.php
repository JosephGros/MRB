<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie_Genre extends Model
{
    use HasFactory;
    protected $table = "serie_genre";

    public function series()
    {
        return $this->belongsTo(Serie::class, "series_id");
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, "genre_id");
    }
}
