@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">{{ __('Multimedias Management') }}</div>

        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="mb-3">
                @can('multimedia-create')
                    <a class="btn btn-primary" href="{{ route('multimedias.create') }}">Create New Multimedia</a>
                @endcan
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Media</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Title</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Type</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Author</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($multimedias as $key => $multimedia)
                            <tr>
                                <td class="border-bottom-0">
                                    @if ($multimedia->type == App\Enums\MultimediaTypeEnum::PICTURE->value)
                                        <img src="{{ url($multimedia->url) }}" style="height: 100px; width: 100px;">
                                    @elseif ($multimedia->type == App\Enums\MultimediaTypeEnum::VIDEO->value)
                                        Video
                                    @else
                                        Audio
                                    @endif
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-normal mb-0">{{ $multimedia->title }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="badge bg-secondary rounded-3 fw-semibold">{{ $multimedia->type }}</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="badge bg-secondary rounded-3 fw-semibold">{{ $multimedia->author->fullname }}</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <a class="btn btn-info" href="{{ route('multimedias.show', $multimedia->id) }}"><i
                                            class="ti ti-eye"></i></a>
                                    @can('multimedia-edit')
                                        <a class="btn btn-primary" href="{{ route('multimedias.edit', $multimedia->id) }}"><i
                                                class="ti ti-edit"></i></a>
                                    @endcan
                                    @can('multimedia-delete')
                                        {{ html()->form('DELETE')->route('multimedias.destroy', $multimedia->id)->attributes(['style' => 'display:inline'])->open() }}
                                        {{ html()->button('<i class="ti ti-trash"></i>', 'submit')->attributes(['onclick' => "return confirm('Are you sure?')"])->class('btn btn-danger') }}
                                        {{ html()->form()->close() }}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                </table>
                {{ $multimedias->render() }}
            </div>
        </div>
    </div>
@endsection
