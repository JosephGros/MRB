<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userList extends Model
{
    use HasFactory;

    protected $table = 'user_lists';
    protected $fillable = ['name', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
