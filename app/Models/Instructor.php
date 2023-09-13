<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Instructor extends User
{
    use HasApiTokens, HasFactory, Notifiable;
    public $table = 'instructors';
    protected $fillable = [
        'name', 'email', 'job_title', 'avatar', 'password',
    ];
    protected $hidden = [
        'password',
        'soail_media_tools',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'password' => 'hashed',
    ];
    public function getImageAttribute()
    {
        if ($this->profile->avatar) {
            return asset('storage/' . $this->profile->avatar);
        }
        return 'https://www.vippng.com/png/detail/202-2026524_person-icon-default-user-icon-png.png';
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    // public function courses()
    // {
    //     return $this->hasMany(Course::class);
    // }
    public function scopeFilter(Builder $builder, ?string $filter)
    {
        return $builder->when($filter ?? false, function ($builder, $value) {
            return $builder->where('name', 'like', "%$value%")->orWhere('id', $value);
        });
    }
    public function courses(): MorphMany
    {
        return $this->morphMany(Course::class, 'user');
    }
}
