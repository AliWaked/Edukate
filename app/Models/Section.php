<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Section extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    public $translatedAttributes = ['lesson_title', 'lectures', 'attachments'];
    public $timestamps = false;
    protected $fillable = [
        'course_id',
        // 'lesson_title',
        // 'lectures',
        // 'attachments',
    ];
    // protected $casts = [
    //     'lectures' => 'json',
    //     'attachments' => 'json',
    // ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function returnString(): string
    {
        return 'bla bla bal';
    }
    public function rules(): array
    {
        return [
            'lesson_title.*' => 'required|string|max:255',
            'lectures.*.title.*' => 'required|string|max:255',
            'lectures.*.file.*' => 'nullable|max:102400',
            'attachments.*.*' => 'nullable|file',
        ];
    }
    public function createSections(Request $request, Course $course): float
    {
        $number = 0;
        // dd($course->slug);
        $slug = $course->slug;
        // dd($request->all());
        $lessonTitle = $request->en_lesson_title;
        $lessonTitleAR = $request->ar_lesson_title;
        $lectureAR = $request->ar_lectures;
        $duration = 0;
        foreach ($request->en_lectures as $lecture) {
            $titles = $lecture['title'];
            $video =  $lecture['file'];
            for ($i = 0; $i < count($titles); $i++) {
                $duration += $this->getVideoDuration($video[$i]);
                $content[$titles[$i]] = $this->uplodeFiles($video[$i], $slug, true);
            }
            $titles = $lectureAR[$number]['title'];
            $video =  $lectureAR[$number]['file'];
            for ($i = 0; $i < count($titles); $i++) {
                $duration += $this->getVideoDuration($video[$i]);
                $contentAR[$titles[$i]] = $this->uplodeFiles($video[$i], $slug, true);
            }
            Section::create([
                'en' => [
                    'lesson_title' => $lessonTitleAR[$number],
                    'lectures' => $content,
                    'attachments' => $this->uplodeFiles($request->ar_attachments[$number], $slug),
                ],
                'ar' => [
                    'lesson_title' => $lessonTitle[$number],
                    'lectures' => $contentAR,
                    'attachments' => $this->uplodeFiles($request->ar_attachments[$number++], $slug),
                ],
                'course_id' => $course->id,
            ]);
            $content = [];
            $contentAR = [];
        }
        return $duration;
    }

    public function uplodeFiles(array|object $files, string $slug, bool $video = false): array|string
    {
        if (is_array($files)) {
            foreach ($files as $file) {
                $paths[$file->getClientOriginalName() . '*' . time()] = Storage::disk('public')->append("courses/$slug/attachments", $file);
            }
            return $paths;
        }
        if ($video) {
            return Storage::disk('public')->append("courses/$slug/videos", $files);
        }
        return Storage::disk('public')->append("courses/$slug", $files);
    }
    public function getVideoDuration(string $videoPath): float
    {
        $getID3 = new \getID3;
        $file = $getID3->analyze($videoPath);
        return $file['playtime_seconds']; //playtime_seconds // 11:53,playtime_string
        // return $file;
    }
    // public function getVideoDurationAttubiue($videoPath) {
    //     $getID3 = new \getID3;
    //     $file = $getID3->analyze($videoPath);
    //     return $file['playtime_seconds'];
    // }
}
