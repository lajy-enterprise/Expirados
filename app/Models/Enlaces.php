<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enlaces extends Model
{
    // use HasFactory;
    protected $table = 'Enlaces';
    
    public function usuarios()
        {
         return $this->belongsToMany(User::class);
        }
}
