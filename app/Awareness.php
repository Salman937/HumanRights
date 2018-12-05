<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Awareness extends Model
{
    protected $fillable = ['title', 'description','image'];

    protected $table = 'awareness';
    
}
