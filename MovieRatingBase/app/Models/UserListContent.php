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
}
