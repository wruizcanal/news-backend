@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
            {{ __('Show Category') }}
        </div>

        <div class="card-body">
            <div class="mb-3">
                {{ html()->label('Name:', 'name')->class('form-label') }}
                {{ $category->name }}
            </div>
            <div class="mb-3">
                {{ html()->label('Description:', 'description')->class('form-label') }}
                {{ $category->description }}
            </div>
        </div>
    </div>
@endsection
