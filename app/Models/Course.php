<?php

namespace App\Models;

// use FFMpeg\FFMpeg;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Course extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    // protected $table = 'courses';
    public $translatedAttributes =  ['name', 'descriptions', 'language'];
    protected $fillable = [
        // 'name',
        // 'descriptions',
        'course_image',
        // 'language',
        'slug',
        'status',
        'price',
        'skill_level',
        'category_id',
        'user_type',
        'user_id',
    ];
    protected static function booted(): void
    {
        static::creating(function (Course $course) {
            $course->user_id = ($auth = Auth::user())->id;
            if ($auth instanceof Admin) {
                $course->user_type = Admin::class;
                $course->status = 'acceptable';
            } else {
                $course->user_type = Instructor::class;
            }
        });
    }
    public function commnets(): HasMany
    {
        return $this->hasMany(Comment::class, 'course_id');
    }
    public function section(): HasMany
    {
        return $this->hasMany(Section::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'user_id')->withPivot(['rating']);
    }
    public function user(): MorphTo
    {
        return $this->morphTo();
    }
    public function scopeFilter(Builder $query,  ?string $filter, ?string $category): void
    {
        // $query->where('name', 'like', "%$filter%");
        $query->when($category ?? false, function (Builder $builder, string $value) {
            $builder->where('category_id', $value);
        });
        // $query->translations();
        $query->whereHas('translations', function ($query) use ($filter) {
            $query->where('name', 'like', '%' . $filter . '%');
        });
        // CourseTranslation::filter($filter, $category);
        // $query->whereIn()
    }
    public function getRatingAttribute(): float
    {
        $rating =  Rating::where('course_id', $this->id)->where('rating', '<>', '0')->avg('rating');
        return round($rating, 1);
    }
    public function getLecturesAttribute()
    {
        $lectures = $this->section->pluck('lectures')->toArray();

        // return (Arr::collapse([['1' => 1,'2' => 2],['1' => 2]]));
        // return array_values($lectures);
        $number = array_reduce($lectures, function ($carry, $item) {
            return $carry += count($item);
        });
        return $number;
        // return Arr::collapse(array_values($lectures));
        // return gettype($lectures);
    }
}
