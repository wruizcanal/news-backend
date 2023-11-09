@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('comments.index') }}"> Back</a>
            {{ __('Edit Comment') }}
        </div>

        <div class="card-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ html()->modelForm($comment, 'PATCH', route('comments.update', $comment->id))->open() }}
            <div class="mb-3">
                {{ html()->label('News:', 'news')->class('form-label') }}
                {{ $news->title }}
                {{ html()->hidden('news', $news->id) }}
            </div>
            <div class="mb-3">
                {{ html()->label('Author:', 'author')->class('form-label') }}
                {{ html()->text('author')->attribute('placeholder', 'Author')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Content:', 'content')->class('form-label') }}
                {{ html()->textarea('content')->attribute('placeholder', 'Content')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Status:', 'status')->class('form-label') }}
                {{ html()->select('status', $status)->attribute('placeholder', 'Status')->class('form-control') }}
            </div>
            <div class="mb-3 text-center">
                {{ html()->button('Submit', 'submit')->class('btn btn-primary') }}
            </div>
            {{ html()->closeModelForm() }}
        </div>
    </div>
@endsection
