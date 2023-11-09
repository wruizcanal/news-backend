@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('multimedias.index') }}">Back</a>
            {{ __('Show Multimedia') }}
        </div>

        <div class="card-body">
            <div class="mb-3">
                {{ html()->label('Multimedia:', 'url')->class('form-label') }}
                @if ($multimedia->type == App\Enums\MultimediaTypeEnum::PICTURE->value)
                    {{ html()->img()->src(url($multimedia->url))->attribute('width', '300px') }}
                @else{
                    {{ $multimedia->url }}
                @endif
            </div>
            <div class="mb-3">
                {{ html()->label('Title:', 'title')->class('form-label') }}
                {{ $multimedia->title }}
            </div>
            <div class="mb-3">
                {{ html()->label('Foot:', 'foot')->class('form-label') }}
                {{ $multimedia->foot }}
            </div>
            <div class="mb-3">
                {{ html()->label('Type:', 'type')->class('form-label') }}
                {{ $multimedia->type }}
            </div>
            <div class="mb-3">
                {{ html()->label('Author:', 'author')->class('form-label') }}
                {{ $multimedia->author->fullname }}
            </div>
        </div>
    </div>
@endsection
