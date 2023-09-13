<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\SectionCollection;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->validate([
            'course_id' => 'required|int|exists:courses,id',
        ]);
        // return  new SectionCollection(Section::where('course_id',$id)->get());
        return SectionResource::collection(Section::where('course_id', $id)->get());
        // return Response::json(SectionResource::collection(Section::where('course_id', $id)->get()));
    }
}
