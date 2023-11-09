@extends('backend.layouts.app')

@section('css')
    <style>
        .checkbox-grid {
            display: flex;
            flex-wrap: wrap;
            list-style-type: none;
        }

        .checkbox-grid li {
            flex: 0 0 25%;
            min-width: 150px;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
            {{ __('Edit Role') }}
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

            {{ html()->modelForm($role, 'PATCH', route('roles.update', $role->id))->open() }}
            <div class="mb-3">
                {{ html()->label('Name:', 'name')->class('form-label') }}
                {{ html()->text('name')->attribute('placeholder', 'Name')->class('form-control')->disabled(in_array($role->name, config('site.default_roles'))) }}
            </div>
            <div class="mb-3 form-group">
                {{ html()->label('Permission:', '')->class('form-label') }}
                <br />
                <ul class="checkbox-grid">
                    @foreach ($permission as $value)
                        <li class="form-check">
                            {{ html()->checkbox('permission[]', in_array($value->id, $rolePermissions) ? true : false, $value->id)->class('form-check-input') }}
                            {{ html()->label($value->name, 'permission[]')->class('form-check-label') }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mb-3 text-center">
                {{ html()->button('Submit', 'submit')->class('btn btn-primary') }}
            </div>
            {{ html()->closeModelForm() }}
        </div>
    </div>
@endsection
