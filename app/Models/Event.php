<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['title', 'description', 'event_date', 'location', 'registration_link', 'image', 'status'])]
class Event extends Model
{
    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_user')
                    ->withPivot('status', 'child_id')
                    ->withTimestamps();
    }
}
