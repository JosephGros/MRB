<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie_Writer extends Model
{
    use HasFactory;
    protected $table = "serie_writer";

    public function series()
    {
        return $this->belongsTo(Serie::class, "series_id");
    }

    public function writer()
    {
        return $this->belongsTo(Writer::class, "writer_id");
    }
}
