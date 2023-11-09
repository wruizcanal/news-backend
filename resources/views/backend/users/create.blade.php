@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('users.index') }}">Back</a>
            {{ __('Create New User') }}
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

            {{ html()->form('POST')->route('users.store')->open() }}
            <div class="mb-3">
                {{ html()->label('Name:', 'name')->class('form-label') }}
                {{ html()->text('name')->value(old('name'))->attribute('placeholder', 'Name')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Email:', 'email')->class('form-label') }}
                {{ html()->email('email')->value(old('email'))->attribute('placeholder', 'Email')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Password:', 'password')->class('form-label') }}
                {{ html()->password('password')->attribute('placeholder', 'Password')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Confirm Password:', 'confirm-password')->class('form-label') }}
                {{ html()->password('confirm-password')->attribute('placeholder', 'Confirm Password')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Role:', 'roles[]')->class('form-label') }}
                {{ html()->multiselect('roles[]', $roles, null)->class('form-control js-select2') }}
            </div>
            <div class="mb-3 form-check">
                {{ html()->checkbox('verified', old('verified'), true)->class('form-check-input') }}
                {{ html()->label('Verified', 'verified')->class('form-check-label') }}
            </div>
            <div class="mb-3 text-center">
                {{ html()->button('Submit', 'submit')->class('btn btn-primary') }}
            </div>
            {{ html()->form()->close() }}
        </div>
    @endsection

    @include('backend.layouts.includes.select2')
