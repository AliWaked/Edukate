<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Rating extends Pivot
{
    use HasFactory;
    public $table = 'course_student';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'course_id', 'rating','status',
    ];
}
