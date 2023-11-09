@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('authors.index') }}">Back</a>
            {{ __('Show Author') }}
        </div>

        <div class="card-body">
            <div class="mb-3">
                {{ html()->label('Avatar:', 'avatar')->class('form-label') }}
                {{ html()->img('avatar')->src(url($author->avatar))->attribute('width', '300px') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Fullname:', 'fullname')->class('form-label') }}
                {{ $author->fullname }}
            </div>
            <div class="mb-3">
                {{ html()->label('Email:', 'email')->class('form-label') }}
                {{ $author->email }}
            </div>
            <div class="mb-3">
                {{ html()->label('Ocupation:', 'ocupation')->class('form-label') }}
                {{ $author->ocupation }}
            </div>
            <div class="mb-3">
                {{ html()->label('Active:', 'active')->class('form-label') }}
                {{ $author->active == 1 ? 'Yes' : 'No' }}
            </div>
        </div>
    </div>
@endsection
