@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">{{ __('Categories Management') }}</div>

        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="mb-3">
                @can('category-create')
                    <a class="btn btn-primary" href="{{ route('categories.create') }}"> Create New Category</a>
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
                                <h6 class="fw-semibold mb-0">Description</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-normal mb-0">{{ $category->name }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-normal mb-0">{{ $category->description }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <a class="btn btn-info" href="{{ route('categories.show', $category->id) }}"><i
                                            class="ti ti-eye"></i></a>
                                    @can('category-edit')
                                        <a class="btn btn-primary" href="{{ route('categories.edit', $category->id) }}"><i
                                                class="ti ti-edit"></i></a>
                                    @endcan
                                    @can('category-delete')
                                        {{ html()->form('DELETE')->route('categories.destroy', $category->id)->attributes(['style' => 'display:inline'])->open() }}
                                        {{ html()->button('<i class="ti ti-trash"></i>', 'submit')->attributes(['onclick' => "return confirm('Are you sure?')"])->class('btn btn-danger') }}
                                        {{ html()->form()->close() }}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                </table>
                {{ $categories->render() }}
            </div>
        </div>
    </div>
@endsection
