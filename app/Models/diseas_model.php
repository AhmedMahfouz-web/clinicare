<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diseas_model extends Model
{
    use HasFactory;

    protected $fillable = [
        'diseas_id',
        'report_id',
        'meeting_id',
        'reservation_id',
        'dentist_id',
    ];
}
