@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
            {{ __('Edit Category') }}
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

            {{ html()->modelForm($category, 'PATCH', route('categories.update', $category->id))->open() }}
            <div class="mb-3">
                {{ html()->label('Name:', 'name')->class('form-label') }}
                {{ html()->text('name')->attribute('placeholder', 'Name')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Description:', 'description')->class('form-label') }}
                {{ html()->text('description')->attribute('placeholder', 'Description')->class('form-control') }}
            </div>
            <div class="mb-3 text-center">
                {{ html()->button('Submit', 'submit')->class('btn btn-primary') }}
            </div>
            {{ html()->closeModelForm() }}
        </div>
    </div>
@endsection
