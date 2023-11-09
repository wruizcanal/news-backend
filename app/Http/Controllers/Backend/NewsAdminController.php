<?php

namespace App\Http\Controllers\Backend;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\NewsCreateAdminRequest;
use App\Http\Requests\Backend\NewsEditAdminRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsAdminController extends Controller
{
    /**
     * Summary of __construct
     */
    function __construct()
    {
        $this->middleware('permission:news-list|news-create|news-edit|news-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:news-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:news-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:news-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function index(Request $request)
    {
        $news = News::orderBy('id', 'DESC')->paginate(5);
        return view('backend.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $status = [];
        foreach (StatusEnum::cases() as $value) {
            $status[$value->value] = $value->value;
        }

        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('backend.news.create', compact('status', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\Backend\NewsCreateAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsCreateAdminRequest $request)
    {
        $input = $request->all();
        $input['cover_picture'] = $input['cover_picture'][0];
        $news = new News();
        $news->title = $input['title'];
        $news->summary = $input['summary'];
        $news->content = $input['content'];
        $news->status = $input['status'];
        if ($news->status == StatusEnum::PUBLISHED->value) {
            $news->published_date = now();
        }
        $news->open_close = isset($input['open_close']) ? true : false;
        $news->category()->associate($input['category']);
        $news->coverPicture()->associate($input['cover_picture']);
        $news->save();

        return redirect()->route('news.index')
            ->with('success', 'News created successfully');
    }

    /**
     * Display the specified resource.
     * @param \App\Models\News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(News $news)
    {
        return view('backend.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, News $news)
    {
        if ($request->ajax()) {
            return response()->json([
                "results" => [$news->coverPicture],
            ], 200);
        }

        $status = [];
        foreach (StatusEnum::cases() as $value) {
            $status[$value->value] = $value->value;
        }

        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('backend.news.edit', compact('news', 'status', 'categories'));
    }

    /**
     * Summary of update
     * @param \App\Http\Requests\Backend\NewsEditAdminRequest $request
     * @param \App\Models\News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsEditAdminRequest $request, News $news)
    {
        $input = $request->all();
        $input['cover_picture'] = $input['cover_picture'][0];
        $news->title = $input['title'];
        $news->summary = $input['summary'];
        $news->content = $input['content'];
        $news->status = $input['status'];
        if (!isset($news->published_date) && $news->status == StatusEnum::PUBLISHED->value) {
            $news->published_date = now();
        } elseif (isset($news->published_date) && $news->status == StatusEnum::SAVED->value) {
            $news->published_date = null;
        }

        $news->open_close = isset($input['open_close']) ? true : false;
        $news->category()->associate($input['category']);
        $news->coverPicture()->associate($input['cover_picture']);
        $news->save();

        return redirect()->route('news.index')
            ->with('success', 'News updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')
            ->with('success', 'News deleted successfully');
    }
}
