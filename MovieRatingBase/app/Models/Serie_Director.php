<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie_Director extends Model
{
    use HasFactory;
    protected $table = "serie_director";

    public function series()
    {
        return $this->belongsTo(Serie::class, "series_id");
    }

    public function director()
    {
        return $this->belongsTo(Director::class, "director_id");
    }
}
