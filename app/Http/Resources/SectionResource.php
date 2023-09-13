<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SectionResource extends JsonResource
{
    // public static $wrap = 'users';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // static::$wrap = 'user';

        // return parent::toArray($request);
        return [
            'lesson_title' => $this->lesson_title,
            'lectures' =>
            $this->getLecures($this->lectures),
            'attachments' => $this->getAttachments($this->attachments),
        ];
    }
    private function getLecures(array $lectures): array
    {
        $reslut = [];
        foreach ($lectures as $key => $value) {
            $reslut[] = ['title' => $key, 'video' => Storage::disk('public')->url($value)];
        }
        return $reslut;
    }
    private function getAttachments($attachments)
    {
        $array = [];
        foreach ($attachments as $key => $value) {
            $array[] = ['name' => \Illuminate\Support\Str::beforeLast($key, '*'), 'content' => Storage::disk('public')->url($value)];
        }
        return $array;
    }
}
