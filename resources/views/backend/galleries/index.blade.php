@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">{{ __('Galleries Management') }}</div>

        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="mb-3">
                @can('gallery-create')
                    <a class="btn btn-primary" href="{{ route('galleries.create') }}"> Create New Gallery</a>
                @endcan
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Multimedias</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galleries as $key => $gallery)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-normal mb-0">{{ $gallery->name }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="badge {{ ($count = $gallery->multimedias()->count()) > 0 ? 'bg-success' : 'bg-danger' }} bg-primary rounded-3 fw-semibold">{{ $count }}</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <a class="btn btn-info" href="{{ route('galleries.show', $gallery->id) }}"><i
                                            class="ti ti-eye"></i></a>
                                    @can('gallery-edit')
                                        <a class="btn btn-primary" href="{{ route('galleries.edit', $gallery->id) }}"><i
                                                class="ti ti-edit"></i></a>
                                    @endcan
                                    @can('gallery-delete')
                                        {{ html()->form('DELETE')->route('galleries.destroy', $gallery->id)->attributes(['style' => 'display:inline'])->open() }}
                                        {{ html()->button('<i class="ti ti-trash"></i>', 'submit')->attributes(['onclick' => "return confirm('Are you sure?')"])->class('btn btn-danger') }}
                                        {{ html()->form()->close() }}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                </table>
                {{ $galleries->render() }}
            </div>
        </div>
    </div>
@endsection
