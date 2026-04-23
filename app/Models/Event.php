<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['title', 'description', 'event_date', 'location', 'image', 'status'])]
class Event extends Model
{
    //
}
