<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Watchlist extends Model
{
    use HasFactory;

    protected $table = 'watchlists';
    protected $fillable = ['user_id', 'media_id', 'media_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
}
