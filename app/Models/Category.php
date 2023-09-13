<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    public $translatedAttributes = ['name', 'description'];
    protected $fillable = [
        // 'name',
        // 'description',
        'status',
        'user_type',
        'user_id',
    ];
    protected static function booted(): void
    {
        static::creating(function (Category $category) {
            $category->user_id = ($auth = Auth::guard('sanctum')->user())->id;
            if ($auth instanceof Admin) {
                $category->user_type = Admin::class;
                $category->status = 'active';
            } elseif ($auth instanceof Instructor) {
                $category->user_type = Instructor::class;
            }
        });
    }
    public function scopeFilter(Builder $builder, ?string $filter = null)
    {
        // dd('hi');
        // return $builder->where('name', 'like', "%$filter%")->orWhere('description', 'like', "%$filter%")->orWhere('status', 'like', "%$filter%");
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function user(): MorphTo
    {
        return $this->morphTo();
    }
}
