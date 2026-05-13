<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'name', 'birth_date', 'gender', 'school', 'hobby', 'medical_notes', 'photo'])]
class Child extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
