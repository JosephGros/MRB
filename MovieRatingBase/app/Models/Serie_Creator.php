<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie_Creator extends Model
{
    use HasFactory;
    protected $table = "serie_creator";

    public function series()
    {
        return $this->belongsTo(Serie::class, "series_id");
    }

    public function creator()
    {
        return $this->belongsTo(Creator::class, "creator_id");
    }
}
