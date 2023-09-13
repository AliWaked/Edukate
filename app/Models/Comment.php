<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment',
        'course_id',
        'user_id',
    ];
    public function student():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function courses():BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_id');
    }
}
