<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Old_Tests extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'show'
    ];
}
