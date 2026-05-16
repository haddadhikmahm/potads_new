<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalInfo extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'image', 'category', 'status', 'address', 'phone', 'regency', 'district'];
}
