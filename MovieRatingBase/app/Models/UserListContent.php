<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserListContent extends Model
{
    use HasFactory;
    
    protected $table = 'user_list_contents';
    protected $fillable = ['user_lists_id', 'media_id', 'media_type'];

    public function userList()
    {
        return $this->belongsTo(userList::class, 'user_lists_id');
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'media_id')->where('media_type', 'movie');
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class, 'media_id')->where('media_type', 'serie');
    }
}
