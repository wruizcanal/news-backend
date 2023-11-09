<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CategoryCreateAdminRequest;
use App\Http\Requests\Backend\CategoryEditAdminRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryAdminController extends Controller
{
    /**
     * Summary of __construct
     */
    function __construct()
    {
         $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','store']]);
         $this->middleware('permission:category-create', ['only' => ['create','store']]);
         $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('id','DESC')->paginate(5);
        return view('backend.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\Backend\CategoryCreateAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryCreateAdminRequest $request)
    {
        $input = $request->all();
        $category = Category::create($input);

        return redirect()->route('categories.index')
                        ->with('success','Category created successfully');
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Category $category)
    {
        return view('backend.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Category $category)
    {
        return view('backend.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Http\Requests\Backend\CategoryEditAdminRequest $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryEditAdminRequest $request, Category $category)
    {
        $input = $request->all();
        $category->update($input);

        return redirect()->route('categories.index')
                        ->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')
                        ->with('success','Category deleted successfully');
    }
}
