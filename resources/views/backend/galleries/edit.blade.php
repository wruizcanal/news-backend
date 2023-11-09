@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('galleries.index') }}">Back</a>
            {{ __('Edit Gallery') }}
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

            {{ html()->modelForm($gallery, 'PATCH', route('galleries.update', $gallery->id))->open() }}
            <div class="mb-3">
                {{ html()->label('Name:', 'name')->class('form-label') }}
                {{ html()->text('name')->attribute('placeholder', 'Name')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Description:', 'description')->class('form-label') }}
                {{ html()->text('description')->attribute('placeholder', 'Desccription')->class('form-control') }}
            </div>
            <div class="col-12 mb-3">
                {{ html()->label('Pictures:', 'pictures[]')->class('form-label') }}
                {{ html()->multiselect('pictures[]', null, null)->class('form-control js-multimedia-data-ajax') }}
            </div>
            <div class="mb-3 text-center">
                {{ html()->button('Submit', 'submit')->class('btn btn-primary') }}
            </div>
            {{ html()->closeModelForm() }}
        </div>
    </div>
@endsection

@include('backend.layouts.includes.select2_multimedias')


