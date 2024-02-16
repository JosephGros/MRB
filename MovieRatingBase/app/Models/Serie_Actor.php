<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie_Actor extends Model
{
    use HasFactory;
    protected $table = "serie_actor";
    protected $fillable = ["role"];

    public function series()
    {
        return $this->belongsTo(Serie::class, "series_id");
    }

    public function actor()
    {
        return $this->belongsTo(Actor::class, "actor_id");
    }
}
