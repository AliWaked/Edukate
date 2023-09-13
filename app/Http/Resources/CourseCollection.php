<?php

namespace App\Http\Resources;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseCollection extends ResourceCollection
{
    // public static $wrap = 'user';
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        // $rating = Rating::where('course_id', $this->id)->where('rating', '<>', '0');
        // $avg = round($rating->avg('rating'), 1);
        // $numberOfStudent = $rating->count();
        return [
            // 'course_id' => $this->id,
            // 'course_name' => $this->name,
            // 'slug' => $this->slug,
            // 'course_image' => $this->course_image,
            // 'instructor_name' => $this->user->name,
            // // 'rating' => $rating,
            // 'rating' => $avg,
            // // 'ratingstudnet' => $numberOfStudent,
            // 'number_of_students' => $this->students()->count(),
            // ...$this->collection,
            // 'numberOfLesccess' => 'idid',
            // 'id' => $this->Id,
            'name' => [
                'first' =>'ali',
                'last' => 'waked',
            ],
        ];
    }
}
