<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionTranslation extends Model
{
    use HasFactory;
    protected $table = 'section_translation';
    protected $fillable = [
        'lesson_title',
        'lectures',
        'attachments',
    ];
    public $timestamps = false;
    protected $casts = [
        'lectures' => 'json',
        'attachments' => 'json',
    ];
}
