@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('authors.index') }}">Back</a>
            {{ __('Edit Author') }}
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

            {{ html()->modelForm($author, 'PATCH', route('authors.update', $author->id))->attribute('enctype', 'multipart/form-data')->open() }}
            <div class="mb-3">
                {{ html()->label('Avatar:', 'avatar')->class('form-label') }}
                {{ html()->input('file', 'avatar')->attribute('placeholder', 'Avatar')->class('form-control') }}
                {{ html()->img()->src(url($author->avatar))->attribute('width', '300px') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Fullname:', 'fullname')->class('form-label') }}
                {{ html()->text('fullname')->attribute('placeholder', 'Fullname')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Email:', 'email')->class('form-label') }}
                {{ html()->email('email')->attribute('placeholder', 'Email')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Ocupation:', 'ocupation')->class('form-label') }}
                {{ html()->select('ocupation', $ocupations)->attribute('placeholder', 'Ocupation')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Details:', 'details')->class('form-label') }}
                {{ html()->textarea('details')->attribute('placeholder', 'Details')->class('form-control') }}
            </div>
            <div class="mb-3 form-check">
                {{ html()->checkbox('active', $author->active, true)->class('form-check-input') }}
                {{ html()->label('Active', 'active')->class('form-check-label') }}
            </div>
            <div class="mb-3 text-center">
                {{ html()->button('Submit', 'submit')->class('btn btn-primary') }}
            </div>
            {{ html()->closeModelForm() }}
        </div>
    </div>
@endsection
