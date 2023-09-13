<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $table = 'informations';
    protected $fillable = [
        'user_id',
        'field_title',
        'birthday',
        'avatar',
        'gender',
    ];
    public function student()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function getAvatarImageAttribute()
    {
        if ($this->avatar) {
            return asset('storage/'.$this->avatar);
        }
        return 'https://www.vippng.com/png/detail/202-2026524_person-icon-default-user-icon-png.png';
    }
}
