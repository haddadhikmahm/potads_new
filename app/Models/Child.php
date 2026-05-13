<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

class Child extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'birth_date',
        'gender',
        'address',
        'special_needs',
        'parent_name',
        'parent_phone',
        'parent_job',
        'parent_address',
        'school_status',
        'school_type',
        'therapies',
        'development_notes',
        'photo'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
