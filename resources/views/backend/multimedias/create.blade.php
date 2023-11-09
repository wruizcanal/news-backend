@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('multimedias.index') }}">Back</a>
            {{ __('Create New Multimedia') }}
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

            {{ html()->form('POST')->route('multimedias.store')->attribute('enctype', 'multipart/form-data')->open() }}
            <div class="mb-3">
                {{ html()->label('Multimedia:', 'url')->class('form-label') }}
                {{ html()->input('file', 'url')->attribute('placeholder', 'Multimedia')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Title:', 'fullname')->class('form-label') }}
                {{ html()->text('title')->value(old('title'))->attribute('placeholder', 'Title')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Foot:', 'foot')->class('form-label') }}
                {{ html()->text('foot')->value(old('foot'))->attribute('placeholder', 'Foot')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Type:', 'type')->class('form-label') }}
                {{ html()->select('type', $multimediasType)->value(old('type'))->attribute('placeholder', 'Type')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Author:', 'author')->class('form-label') }}
                {{ html()->select('author', $authors)->value(old('author'))->attribute('placeholder', 'Author')->class('form-control') }}
            </div>
            <div class="mb-3 text-center">
                {{ html()->button('Submit', 'submit')->class('btn btn-primary') }}
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#type').on('change', function(e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            if(valueSelected == "{{ App\Enums\MultimediaTypeEnum::PICTURE->value}}"){
                $('#url').attr('type', 'file');
            }else{
                $('#url').attr('type', 'text');
            }
        });
    </script>
@endsection
