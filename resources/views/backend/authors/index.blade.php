@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">{{ __('Authors Management') }}</div>

        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="mb-3">
                @can('author-create')
                    <a class="btn btn-primary" href="{{ route('authors.create') }}"> Create New Author</a>
                @endcan
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Avatar</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Fullname</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Email</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Active</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Ocupation</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($authors as $key => $author)
                            <tr>
                                <td class="border-bottom-0">
                                    <img src="{{ url($author->avatar) }}" style="height: 100px; width: 100px;">
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-normal mb-0">{{ $author->fullname }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-normal mb-0">{{ $author->email }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="badge {{ $author->active == 1 ? 'bg-success' : 'bg-danger' }} rounded-3 fw-semibold">{{ $author->active == 1 ? 'Yes' : 'No' }}</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-primary rounded-3 fw-semibold">{{ $author->ocupation }}</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <a class="btn btn-info" href="{{ route('authors.show', $author->id) }}"><i
                                            class="ti ti-eye"></i></a>
                                    @can('author-edit')
                                        <a class="btn btn-primary" href="{{ route('authors.edit', $author->id) }}"><i
                                                class="ti ti-edit"></i></a>
                                    @endcan
                                    @can('author-delete')
                                        {{ html()->form('DELETE')->route('authors.destroy', $author->id)->attributes(['style' => 'display:inline'])->open() }}
                                        {{ html()->button('<i class="ti ti-trash"></i>', 'submit')->attributes(['onclick' => "return confirm('Are you sure?')"])->class('btn btn-danger') }}
                                        {{ html()->form()->close() }}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                </table>
            </div>
            {{ $authors->render() }}
        </div>
    </div>
@endsection
