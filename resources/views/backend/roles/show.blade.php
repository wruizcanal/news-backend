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
            {{ __('Show Role') }}
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>

        <div class="card-body">
            <div class="mb-3">
                {{ html()->label('Name:', 'name')->class('form-label') }}
                {{ $role->name }}
            </div>
            <div class="mb-3 form-group">
                {{ html()->label('Permission:', '')->class('form-label') }}
                <br />
                <ul class="checkbox-grid">
                    @if (!empty($rolePermissions))
                            @foreach ($rolePermissions as $value)
                            <li class="form-check">
                                {{ html()->checkbox('permission[]', true, $value->id)->class('form-check-input')->disabled(true) }}
                                {{ html()->label($value->name, 'permission[]')->class('form-check-label') }}
                            </li>
                            @endforeach
                        @endif
                </ul>
            </div>

        </div>
    </div>
@endsection
