@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">{{ __('Create New User') }}</div>

        <div class="card-body">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>

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


            {!! html()->form('POST')->route('users.store')->open() !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! html()->text('name')->value(null)->attribute('placeholder', 'Name')->class('form-control') !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {!! html()->text('email')->value(null)->attribute('placeholder', 'Email')->class('form-control') !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Password:</strong>
                        {!! html()->password('password')->attribute('placeholder', 'Password')->class('form-control') !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Confirm Password:</strong>
                        {!! html()->password('confirm-password')->attribute('placeholder', 'Confirm Password')->class('form-control') !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Role:</strong>
                        {!! html()->multiselect('roles[]', $roles, null)->class('form-control js-select2') !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Verified:</strong>
                        {!! html()->checkbox('verified', false, true)->class('name') !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    {!! html()->button('Submit', 'submit')->class('btn btn-primary') !!}
                </div>
            </div>
            {!! html()->form()->close() !!}
        </div>
    @endsection

    @include('backend.layouts.includes.select2')
