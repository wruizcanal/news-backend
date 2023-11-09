@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('multimedias.index') }}">Back</a>
            {{ __('Edit Multimedia') }}
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

            {{ html()->modelForm($multimedia, 'PATCH', route('multimedias.update', $multimedia->id))->attribute('enctype', 'multipart/form-data')->open() }}
            <div class="mb-3">
                {{ html()->label('Multimedia:', 'url')->class('form-label') }}
                @if ($multimedia->type == App\Enums\MultimediaTypeEnum::PICTURE->value)
                    {{ html()->input('file', 'url')->attribute('placeholder', 'Multimedia')->class('form-control') }}
                    {{ html()->img()->src(url($multimedia->url))->attribute('width', '300px') }}
                @else{
                    {{ html()->text('url')->attribute('placeholder', 'Multimedia')->class('form-control') }}
                @endif
            </div>
            <div class="mb-3">
                {{ html()->label('Title:', 'fullname')->class('form-label') }}
                {{ html()->text('title')->attribute('placeholder', 'Title')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Foot:', 'foot')->class('form-label') }}
                {{ html()->text('foot')->attribute('placeholder', 'Foot')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Type:', 'type')->class('form-label') }}
                {{ html()->select('type', $multimediasType)->attribute('placeholder', 'Type')->class('form-control')->disabled(true) }}
            </div>
            <div class="mb-3">
                {{ html()->label('Author:', 'author')->class('form-label') }}
                {{ html()->select('author', $authors)->attribute('placeholder', 'Author')->class('form-control') }}
            </div>
            <div class="mb-3 text-center">
                {{ html()->button('Submit', 'submit')->class('btn btn-primary') }}
            </div>
            {{ html()->closeModelForm() }}
        </div>
    </div>
@endsection
