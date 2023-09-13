<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $primaryKey = 'instructor_id';
    public $incrementing = false;
    protected $fillable = [
        'instructor_id',
        'birthday',
        'gender',
        'country',
        'city',
        'street',
        'avatar',
        'job_title',
        'message',
        'socail_media',
    ];
    protected $casts = [
        'socail_media' => 'json',
    ];
    public function instructor()
    {
        return $this->hasOne(Instructor::class);
    }
    public function getAvatarImageAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        return 'https://www.vippng.com/png/detail/202-2026524_person-icon-default-user-icon-png.png';
    }
}
