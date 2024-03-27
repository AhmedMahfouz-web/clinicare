<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Hospital;
use App\Models\Test;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'hospital_id',
        'test_id',
        'date',
        'status',
        'transaction',
        'notes',
        'tests',
        'diseas',
        'rays',
        'analysis',
    ];
    protected $casts = [
        'test' => 'array',
        'diseas' => 'array',
        'rays' => 'array',
        'analysis' => 'array',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }


    protected function test(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value, JSON_UNESCAPED_UNICODE),
        );
    }

    protected function diseas(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value, JSON_UNESCAPED_UNICODE),
        );
    }

    protected function rays(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value, JSON_UNESCAPED_UNICODE),
        );
    }

    protected function analysis(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value, JSON_UNESCAPED_UNICODE),
        );
    }
}
