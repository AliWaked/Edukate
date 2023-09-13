<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate(['filter' => 'sometimes|nullable|string|max:255']);
        return Category::filter($request->filter)->select('id', 'name', 'description', 'status')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        Category::create($data);
        return Response::json(['message'=> 'created new category successflly'],201,['location'=>url('/')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // return $category->load('user');
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:255'
        ]);
        // return $request->post('name');
         $category->update($data);
        // if ($bool) {

        return Response::json([
            'message' => 'updated successflly',
        ], 200, ['location' => url('/categories')]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return Response::json(['message' => 'deleted succssflly'],200,['location'=>'']);
    }
}
