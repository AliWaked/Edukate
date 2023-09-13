<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTranslation extends Model
{
    use HasFactory;
    protected $table = 'course_translation';
    protected $fillable = ['name', 'descriptions', 'language'];
    public $timestamps = false;
    
    public function scopeFilter(Builder $query,  ?string $filter, ?string $category): void
    {
        $query->where('name', 'like', "%$filter%");
        $query->when($category ?? false, function (Builder $builder, string $value) {
            $builder->where('category_id', $value);
        });
        // $query->whereIn()
    }
}
