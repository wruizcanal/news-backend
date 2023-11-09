@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('users.index') }}">Back</a>
            {{ __('Edit User') }}
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

            {{ html()->modelForm($user, 'PATCH', route('users.update', $user->id))->open() }}
            <div class="mb-3">
                {{ html()->label('Name:', 'name')->class('form-label') }}
                {{ html()->text('name')->attribute('placeholder', 'Name')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Email:', 'email')->class('form-label') }}
                {{ html()->email('email')->attribute('placeholder', 'Email')->class('form-control')->disabled(true) }}
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
                {{ html()->multiselect('roles[]', $roles, $userRole)->class('form-control js-select2') }}
            </div>
            <div class="mb-3 form-check">
                {{ html()->checkbox('verified', $user->email_verified_at, true)->class('form-check-input') }}
                {{ html()->label('Verified', 'verified')->class('form-check-label') }}
            </div>
            <div class="mb-3 text-center">
                {{ html()->button('Submit', 'submit')->class('btn btn-primary') }}
            </div>
            {{ html()->closeModelForm() }}
        </div>
    </div>
@endsection

@include('backend.layouts.includes.select2')
