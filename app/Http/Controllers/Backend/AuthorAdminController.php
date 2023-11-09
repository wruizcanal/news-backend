<?php

namespace App\Http\Controllers\Backend;

use App\Enums\OcupationEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AuthorCreateAdminRequest;
use App\Http\Requests\Backend\AuthorEditAdminRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorAdminController extends Controller
{
    /**
     * Summary of __construct
     */
    function __construct()
    {
         $this->middleware('permission:author-list|author-create|author-edit|author-delete', ['only' => ['index','store']]);
         $this->middleware('permission:author-create', ['only' => ['create','store']]);
         $this->middleware('permission:author-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:author-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function index(Request $request)
    {
        $authors = Author::orderBy('id','DESC')->paginate(2);
        return view('backend.authors.index',compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $ocupations = [];
        foreach (OcupationEnum::cases() as $value) {
            $ocupations[$value->value] = $value->value;
        }

        return view('backend.authors.create', compact('ocupations'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\Backend\AuthorCreateAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AuthorCreateAdminRequest $request)
    {
        $input = $request->all();
        if(empty($input['active'])){
            $input['active'] = false;
        }

        if ($avatar = $request->file('avatar')) {
            $destinationPath = 'images/';
            $postImage = date('YmdHis') . "." . $avatar->getClientOriginalExtension();
            $avatar->move($destinationPath, $postImage);
            $input['avatar'] = "$destinationPath$postImage";
        }

        Author::create($input);

        return redirect()->route('authors.index')
                        ->with('success','Author created successfully');
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Author $author
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Author $author)
    {
        return view('backend.authors.show',compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\Author $author
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Author $author)
    {
        $ocupations = [];
        foreach (OcupationEnum::cases() as $value) {
            $ocupations[$value->value] = $value->value;
        }
        return view('backend.authors.edit',compact('author','ocupations'));
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Http\Requests\Backend\AuthorEditAdminRequest $request
     * @param \App\Models\Author $author
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AuthorEditAdminRequest $request, Author $author)
    {
        $input = $request->all();
        if(empty($input['active'])){
            $input['active'] = false;
        }

        if ($avatar = $request->file('avatar')) {
            $destinationPath = 'images/';
            $postImage = date('YmdHis') . "." . $avatar->getClientOriginalExtension();
            $avatar->move($destinationPath, $postImage);
            $input['avatar'] = "$destinationPath$postImage";
            $old_url = $author->avatar;
        }

        $author->update($input);

        if(isset($old_url)){
            unlink($old_url);
        }

        return redirect()->route('authors.index')
                        ->with('success','Author updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Author $author
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index')
                        ->with('success','Author deleted successfully');
    }
}
