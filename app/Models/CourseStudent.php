<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    use HasFactory;
    protected $table = 'course_student';
    // public $primaryKey = 
    public $incrementing = false;
    protected $fillable = [
        'user_id','course_id',
    ];
}
