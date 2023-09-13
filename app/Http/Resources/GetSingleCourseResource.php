<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class GetSingleCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => Storage::disk('public')->url($this->course_image),
            'description' => $this->descriptions,
            'cateogry_id' => $this->category_id,
            'Features' => [
                'instructor' => $this->user->name,
                'rating' => $this->rating,
                'lectures' => $this->lectures,
                'duration' => $this->duration,
                'skill_level' => $this->skill_level,
                'language' => $this->language,
                'price' => $this->price,
            ],
            // 'contents' => [

            // ],
            // 'comments' => [

            // ],

        ];
    }
}
