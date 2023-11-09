<?php

namespace App\Http\Controllers\Backend;

use App\Enums\MultimediaTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\GalleryCreateAdminRequest;
use App\Http\Requests\Backend\GalleryEditAdminRequest;
use App\Models\Gallery;
use App\Models\Multimedia;
use Illuminate\Http\Request;

class GalleryAdminController extends Controller
{
    /**
     * Summary of __construct
     */
    function __construct()
    {
        $this->middleware('permission:gallery-list|gallery-create|gallery-edit|gallery-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:gallery-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:gallery-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:gallery-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function index(Request $request)
    {
        $galleries = Gallery::orderBy('id', 'DESC')->paginate(5);
        return view('backend.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('backend.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\Backend\GalleryCreateAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GalleryCreateAdminRequest $request)
    {
        $input = $request->all();
        $gallery = Gallery::create($input);
        $gallery->multimedias()->sync($input['pictures']);
        $gallery->save();

        return redirect()->route('galleries.index')
            ->with('success', 'Gallery created successfully');
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Gallery $gallery
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, Gallery $gallery)
    {
        $multimedias = $gallery->multimedias()->orderBy('title', 'ASC')->paginate(1);
        return view('backend.galleries.show', compact('gallery', 'multimedias'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\Gallery $gallery
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, Gallery $gallery)
    {
        if ($request->ajax()) {
            return response()->json([
                "results" => $gallery->multimedias,
            ], 200);
        }
        return view('backend.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Http\Requests\Backend\GalleryEditAdminRequest $request
     * @param \App\Models\Gallery $gallery
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GalleryEditAdminRequest $request, Gallery $gallery)
    {
        $input = $request->all();
        $gallery->update($input);
        $gallery->multimedias()->sync($input['pictures']);
        $gallery->save();

        return redirect()->route('galleries.index')
            ->with('success', 'Gallery updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Gallery $gallery
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('galleries.index')
            ->with('success', 'Gallery deleted successfully');
    }
}
