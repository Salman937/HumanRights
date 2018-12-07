<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = ['name','designation','office_number'];
    
    protected $table = 'phone_dir';
}
