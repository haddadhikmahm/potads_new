<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'username', 'phone', 'profession', 'city', 'address', 'is_parent', 'role', 'avatar', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function completedMaterials()
    {
        return $this->belongsToMany(Material::class, 'user_material_progress', 'user_id', 'material_id')
                    ->withPivot('completed_at')
                    ->withTimestamps();
    }

    public function children()
    {
        return $this->hasMany(Child::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_user')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}
