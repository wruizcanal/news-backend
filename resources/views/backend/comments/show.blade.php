@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('comments.index') }}">Back</a>
            {{ __('Show Comment') }}
        </div>

        <div class="card-body">
            <div class="mb-3">
                {{ html()->label('News:', 'news')->class('form-label') }}
                {{ $comment->news->title }}
            </div>
            <div class="mb-3">
                {{ html()->label('Author:', 'author')->class('form-label') }}
                {{ $comment->author }}
            </div>
            <div class="mb-3">
                {{ html()->label('Content:', 'content')->class('form-label') }}
                {{ $comment->content }}
            </div>
            <div class="mb-3">
                {{ html()->label('Status:', 'status')->class('form-label') }}
                <span class="badge {{ $comment->status == App\Enums\StatusEnum::PUBLISHED->value ? 'bg-success' : 'bg-danger' }} rounded-3 fw-semibold">{{ $comment->status }}</span>
            </div>
        </div>
    </div>
@endsection
