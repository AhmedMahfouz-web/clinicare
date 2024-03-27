<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Old_Test_Model extends Model
{
    use HasFactory;

    protected $fillable = [
        'old_test_id',
        'report_id',
        'meeting_id',
        'reservation_id',
        'dentist_id',
    ];
}
