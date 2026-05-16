<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

class Material extends Model
{
    protected $fillable = [
        'title', 
        'description', 
        'quiz_data', 
        'type', 
        'url', 
        'file_path', 
        'category', 
        'sort_order', 
        'level',
        'image',
        'audience'
    ];

    protected $casts = [
        'quiz_data' => 'array',
    ];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function completedBy()
    {
        return $this->belongsToMany(User::class, 'user_material_progress', 'material_id', 'user_id')
                    ->withPivot('completed_at')
                    ->withTimestamps();
    }
}
