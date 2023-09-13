<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // App::locale('en');
        // dd(Session::get('_token'));
        if (Auth::guard()->name == 'admin') {
            return view('dashboard.admin.categories', [
                'categories' => Category::filter($request->filter)->orderBy('id', 'desc')->paginate(),
                'filter' => $request->filter,
            ]);
        }
        return view('dashboard.instructor.categories', [
            'categories' => Category::filter($request->filter)->paginate(),
            'filter' => $request->filter,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dashboard.instructor.add_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        // $data = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'required|string|max:255',
        // ], [
        //     'name.required' => 'The name category is requried',
        //     'description.required' => 'The description category is requried',
        //     'string' => 'The type must be string',
        //     'max' => 'The max length 255 letter',
        // ]);
        // dd($request->validated());
        Category::create($request->validated());
        if (Auth::guard()->name == 'admin') {
            return to_route('dashboard.category.index')->with('success', 'A New Category Has Been Created Successfully');
        }
        return to_route('dashboard.instructor.category.index')->with('success', 'A New Category Has Been Created Successfully');
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        $user = (new $category->user_type)->findOrFail($category->user_id);
        if ($user instanceof Admin) {
            $creating_by = 'Admin has name ' . '"' . $user->name . '"' . ' and id equal ' . '"' . $user->id . '"';
        } else {
            $creating_by = 'instructor has name ' . '"' . $user->name . '"' . ' and id equal ' . '"' . $user->id . '"';
        }
        return view('dashboard.admin.category-edit', ['category' => $category, 'creating_by' => $creating_by]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        if (!$request->has('name')) {
            if ($category->status == 'draft') {
                $category->update([
                    'status' => 'active',
                ]);
                $session = 'The Category Has Been Active';
                $status = 'success';
            } else {
                $category->update([
                    'status' => 'draft',
                ]);
                $status = 'info';
                $session = 'The Category Has Been Draft';
            }
            return to_route('dashboard.category.index')->with($status, $session);
        }
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return to_route('dashboard.category.index')->with('success', 'The Category Has Been Updated Successflly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Category::findOrFail($id)->delete();
        return to_route('dashboard.category.index')->with('delete', 'The Category Has Been Deleted Successflly');
    }
}
