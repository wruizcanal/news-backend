<?php

namespace App\Http\Controllers\Backend;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CommentAdminRequest;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class CommentAdminController extends Controller
{
    /**
     * Summary of __construct
     */
    function __construct()
    {
         $this->middleware('permission:comment-list|comment-create|comment-edit|comment-delete', ['only' => ['index','store']]);
         $this->middleware('permission:comment-create', ['only' => ['create','store']]);
         $this->middleware('permission:comment-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:comment-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function index(Request $request)
    {
        $comments = Comment::orderBy('id','ASC')->paginate(5);
        return view('backend.comments.index',compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $status = [];
        foreach (StatusEnum::cases() as $value) {
            $status[$value->value] = $value->value;
        }

        $news = News::find($request->input('news'))->first(['title','id']);
        return view('backend.comments.create', compact('news','status'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\Backend\CommentAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentAdminRequest $request)
    {
        $input = $request->all();
        $comment = New Comment();
        $comment->author = $input['author'];
        $comment->content = $input['content'];
        $comment->status = $input['status'];
        $comment->news()->associate($input['news']);
        $comment->save();

        return redirect()->route('comments.index')
                        ->with('success','Comment created successfully');
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Comment $comment)
    {
        return view('backend.comments.show',compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Comment $comment)
    {
        $status = [];
        foreach (StatusEnum::cases() as $value) {
            $status[$value->value] = $value->value;
        }

        $news = News::find($comment->news_id)->first(['title','id']);
        return view('backend.comments.edit', compact('comment','news','status'));
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Http\Requests\Backend\CommentAdminRequest $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CommentAdminRequest $request, Comment $comment)
    {
        $input = $request->all();
        $comment->author = $input['author'];
        $comment->content = $input['content'];
        $comment->status = $input['status'];
        $comment->news()->associate($input['news']);
        $comment->save();

        return redirect()->route('comments.index')
                        ->with('success','Comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comments.index')
                        ->with('success','Comment deleted successfully');
    }
}
