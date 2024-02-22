<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    protected $table = "episodes";
    protected $fillable = ["episode_count", "name", "runtime", "description", "season_id"];
    

    public function seasons()
    {
        return $this->belongsTo(Season::class);
    }
}
