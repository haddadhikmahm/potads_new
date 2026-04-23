<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['title', 'description', 'type', 'url', 'file_path', 'category'])]
class Material extends Model
{
    //
}
