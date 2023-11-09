@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('galleries.index') }}"> Back</a>
            {{ __('Show Gallery') }}
        </div>

        <div class="card-body">
            <div class="mb-3">
                {{ html()->label('Name:', 'name')->class('form-label') }}
                {{ $gallery->name }}
            </div>
            <div class="mb-3">
                {{ html()->label('Description:', 'description')->class('form-label') }}
                {{ $gallery->description }}
            </div>
            <div class="mb-3">
                {{ html()->label('Multimedias:', 'multimedias')->class('form-label') }}
            </div>

            <div class="row align-items-end">
                @foreach ($multimedias as $multimedia)
                    <div class="col-6 col-sm-3 col-xl-2">
                        <div class="card overflow-hidden rounded-2">
                            <div class="position-relative">
                                <img src="{{ url($multimedia->url) }}" class="card-img-top rounded-0"
                                    alt="{{ $multimedia->title }}">
                                <div class="card-body pt-1 p-1">
                                    <h6>{{ $multimedia->title }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $multimedias->render() }}
        </div>
    </div>
@endsection
