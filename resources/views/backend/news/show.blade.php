@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('news.index') }}">Back</a>
            {{ __('Show News') }}
        </div>

        <div class="card-body">
            <div class="mb-3">
                {{ html()->label('Cover Picture:', 'url')->class('form-label') }}
                {{ html()->img('url')->src(url($news->coverPicture->url))->attribute('width', '300px') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Title:', 'title')->class('form-label') }}
                {{ $news->title }}
            </div>
            <div class="mb-3">
                {{ html()->label('Summary:', 'summary')->class('form-label') }}
                {{ $news->summary }}
            </div>
            <div class="mb-3">
                {{ html()->label('Content:', 'content')->class('form-label') }}
                {{ $news->content }}
            </div>
            <div class="mb-3">
                {{ html()->label('Status:', 'status')->class('form-label') }}
                {{ $news->status }}
            </div>
            <div class="mb-3">
                {{ html()->label('Category:', 'category')->class('form-label') }}
                {{ $news->category->name }}
            </div>
            <div class="mb-3">
                {{ html()->label('Published Date:', 'published_date')->class('form-label') }}
                {{ isset($news->published_date) ? $news->published_date : 'Not Set' }}
            </div>
            <div class="mb-3">
                {{ html()->label('Open:', 'open_close')->class('form-label') }}
                {{ $news->open_close == 1 ? 'Yes' : 'No' }}
            </div>
        </div>
    </div>
@endsection
