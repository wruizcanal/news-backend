@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            {{ __('Show User') }}
        </div>

        <div class="card-body">
            <div class="mb-3">
                {{ html()->label('Name:', 'name')->class('form-label') }}
                {{ $user->name }}
            </div>
            <div class="mb-3">
                {{ html()->label('Email:', 'email')->class('form-label') }}
                {{ $user->email }}
            </div>

            <div class="mb-3">
                {{ html()->label('Roles:', 'email')->class('form-label') }}
                @if (!empty($user->getRoleNames()))
                    @foreach ($user->getRoleNames() as $v)
                        <span class="badge bg-primary rounded-3 fw-semibold">{{ $v }}</span>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
