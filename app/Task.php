<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 
        'description', 
        'responsible_id',
        'created_by',
        'status',
        'deadline'
    ];
}
