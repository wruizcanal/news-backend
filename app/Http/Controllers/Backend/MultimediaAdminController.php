<?php

namespace App\Http\Controllers\Backend;

use App\Enums\MultimediaTypeEnum;
use App\Enums\OcupationEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\MultimediaCreateAdminRequest;
use App\Http\Requests\Backend\MultimediaEditAdminRequest;
use App\Models\Author;
use App\Models\Multimedia;
use Illuminate\Http\Request;

class MultimediaAdminController extends Controller
{
    /**
     * Summary of __construct
     */
    function __construct()
    {
        $this->middleware('permission:multimedia-list|multimedia-create|multimedia-edit|multimedia-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:multimedia-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:multimedia-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:multimedia-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $page = $request->page;
            $term = $request->search;

            $multimedias = Multimedia::query()->where('type', MultimediaTypeEnum::PICTURE->value)
                                ->where("title", "LIKE", "%".$term."%")->select(['id', 'title', 'foot', 'url'])->simplePaginate(10);
                                
            return response()->json([
                "results" => $multimedias->items(),
                "pagination" => [
                    "more" => $multimedias->hasMorePages()
                ]
            ], 200);
        }

        $multimediasType = [];
        foreach (MultimediaTypeEnum::cases() as $value) {
            $multimediasType[$value->value] = $value->value;
        }

        $authors = Author::query()->where('ocupation', OcupationEnum::PHOTOGRAPHER->value)->where('active', true)->orderBy('fullname', 'ASC')->pluck('fullname', 'id');

        $multimedias = Multimedia::orderBy('id', 'DESC')->paginate(5);
        return view('backend.multimedias.index', compact('multimedias', 'multimediasType', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $multimediasType = [];
        foreach (MultimediaTypeEnum::cases() as $value) {
            $multimediasType[$value->value] = $value->value;
        }

        $authors = Author::query()->where('ocupation', OcupationEnum::PHOTOGRAPHER->value)->where('active', true)->orderBy('fullname', 'ASC')->pluck('fullname', 'id');

        return view('backend.multimedias.create', compact('multimediasType', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\Backend\MultimediaCreateAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MultimediaCreateAdminRequest $request)
    {
        $input = $request->all();
        $multimedia = new Multimedia();
        $multimedia->title = $input['title'];
        $multimedia->foot = $input['foot'];

        if ($media = $request->file('url')) {
            $destinationPath = 'images/';
            $postImage = date('YmdHis') . "." . $media->getClientOriginalExtension();
            $media->move($destinationPath, $postImage);
            $input['url'] = "$destinationPath$postImage";
        }

        $multimedia->url = $input['url'];
        $multimedia->type = $input['type'];
        $multimedia->author()->associate($input['author']);
        $multimedia->save();

        return redirect()->route('multimedias.index')
            ->with('success', 'Multimedia created successfully');
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Multimedia $multimedia
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Multimedia $multimedia)
    {
        return view('backend.multimedias.show', compact('multimedia'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\Multimedia $multimedia
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Multimedia $multimedia)
    {
        $multimediasType = [];
        foreach (MultimediaTypeEnum::cases() as $value) {
            $multimediasType[$value->value] = $value->value;
        }

        $authors = Author::query()->where('ocupation', OcupationEnum::PHOTOGRAPHER->value)->where('active', true)->orderBy('fullname', 'ASC')->pluck('fullname', 'id');

        return view('backend.multimedias.edit', compact('multimedia', 'multimediasType', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Http\Requests\Backend\MultimediaEditAdminRequest $request
     * @param \App\Models\Multimedia $multimedia
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MultimediaEditAdminRequest $request, Multimedia $multimedia)
    {
        $input = $request->all();

        if ($media = $request->file('url')) {
            $destinationPath = 'images/';
            $postImage = date('YmdHis') . "." . $media->getClientOriginalExtension();
            $media->move($destinationPath, $postImage);
            $input['url'] = "$destinationPath$postImage";
            $old_url = $multimedia->url;
        }

        $multimedia->update($input);
        $multimedia->author()->associate($input['author']);
        $multimedia->save();

        if (isset($old_url)) {
            unlink($old_url);
        }

        return redirect()->route('multimedias.index')
            ->with('success', 'Multimedia updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Multimedia $multimedia
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Multimedia $multimedia)
    {
        $multimedia->delete();
        return redirect()->route('multimedias.index')
            ->with('success', 'Multimedia deleted successfully');
    }
}
