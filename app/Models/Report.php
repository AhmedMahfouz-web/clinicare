<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Doctor;
use App\Models\file;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'desc',
        'profession',
        'family_related',
        'sleep_on_hospital',
        'surgery',
        'notes',
        'doctor_id',
        'doctor_comment',
        'user_id',
        'transaction',
        'notes',
        'tests',
        'diseas'
    ];
    protected $casts = [
        'test' => 'array',
        'diseas' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    public function files()
    {
        return $this->hasMany(file::class);
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
}
