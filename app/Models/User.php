<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'start_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'start_at' => 'date:Y-m-d',
    ];



    protected function startAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? Carbon::parse($value)->format('m/d/Y') : null,
            set: fn($value) => $value ? Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d') : null,
        );
    }

    // ارتباط با نقش‌ها (Many-to-Many)
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // ارتباط با پروژه‌ها
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // ارتباط با دسته‌بندی‌ها
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
