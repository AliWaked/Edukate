<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Laravel\Sanctum\HasApiTokens;

class Admin extends User
{
    use HasFactory , HasApiTokens;
    protected $fillable = [
        'name','password','avatar','email',
    ];
    protected $hidden = [
        // 'created_at','updated_at','password','avatar',
    ];
    public function getImageAttribute()
    {
        if ($this->avatar) {
            return $this->avatar;
        }
        return 'https://www.vippng.com/png/detail/202-2026524_person-icon-default-user-icon-png.png';
    }
}
