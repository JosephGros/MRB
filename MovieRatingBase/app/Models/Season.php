<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $table = "seasons";
    protected $fillable = ["name", "number_of_episodes", "series_id"];

    public function series()
    {
        return $this->belongsTo(Serie::class);
    }
}
