@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">{{ __('Create New Role') }}</div>

        <div class="card-body">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
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

            {!! html()->form('POST')->route('roles.store')->open() !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! html()->text('name')->value(null)->attribute('placeholder', 'Name')->class('form-control') !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permission:</strong>
                        <br />
                        @foreach ($permission as $value)
                            <label>{!! html()->checkbox('permission[]', false, $value->id)->class('name') !!}
                                {{ $value->name }}</label>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    {!! html()->button('Submit', 'submit')->class('btn btn-primary') !!}
                </div>
            </div>
            {!! html()->form()->close() !!}
        </div>
    </div>
@endsection
