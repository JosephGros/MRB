<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    protected $fillable = ['name', 'email', 'message']; // Lägg till alla fält du vill kunna mass-assigna
}
