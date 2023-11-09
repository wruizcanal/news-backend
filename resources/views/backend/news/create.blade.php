@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('news.index') }}">Back</a>
            {{ __('Create New News') }}
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

            {{ html()->form('POST')->route('news.store')->open() }}
            <div class="col-12 mb-3">
                {{ html()->label('Cover Picture:', 'cover_picture[]')->class('form-label') }}
                {{ html()->multiselect('cover_picture[]', null, null)->class('form-control js-multimedia-data-ajax') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Title:', 'title')->class('form-label') }}
                {{ html()->text('title')->value(old('title'))->attribute('placeholder', 'Title')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Summary:', 'summary')->class('form-label') }}
                {{ html()->textarea('summary')->value(old('summary'))->attribute('placeholder', 'Summary')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Content:', 'content')->class('form-label') }}
                {{ html()->textarea('content')->value(old('content'))->attribute('placeholder', 'Content')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Status:', 'status')->class('form-label') }}
                {{ html()->select('status', $status)->value(old('status'))->attribute('placeholder', 'Status')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Category:', 'category')->class('form-label') }}
                {{ html()->select('category', $categories)->value(old('category'))->attribute('placeholder', 'Category')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Published Date:', 'published_date')->class('form-label') }}
                {{ html()->text('published_date')->value(old('published_date'))->attribute('placeholder', 'Not Set')->disabled(true)->class('form-control') }}
            </div>
            <div class="mb-3 form-check">
                {{ html()->checkbox('open_close', old('open_close'), true)->class('form-check-input') }}
                {{ html()->label('Open', 'open_close')->class('form-check-label') }}
            </div>
            <div class="mb-3 text-center">
                {{ html()->button('Submit', 'submit')->class('btn btn-primary') }}
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
@endsection

@include('backend.layouts.includes.select2_multimedias')
