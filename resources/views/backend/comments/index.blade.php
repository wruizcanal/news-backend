@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">{{ __('Comments Management') }}</div>

        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">News</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Author</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Status</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $key => $comment)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-normal mb-0">{{ $comment->news->title }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-normal mb-0">{{ $comment->author }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="badge {{ $comment->status == App\Enums\StatusEnum::PUBLISHED->value ? 'bg-success' : 'bg-danger' }} rounded-3 fw-semibold">{{ $comment->status }}</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <a class="btn btn-info" href="{{ route('comments.show', $comment->id) }}"><i class="ti ti-eye"></i></a>
                                    @can('comment-edit')
                                        <a class="btn btn-primary" href="{{ route('comments.edit', $comment->id) }}"><i class="ti ti-edit"></i></a>
                                    @endcan
                                    @can('comment-delete')
                                        {{ html()->form('DELETE')->route('comments.destroy', $comment->id)->attributes(['style' => 'display:inline'])->open() }}
                                        {{ html()->button('<i class="ti ti-trash"></i>', 'submit')->attributes(['onclick' => "return confirm('Are you sure?')"])->class('btn btn-danger') }}
                                        {{ html()->form()->close() }}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                </table>
                {{ $comments->render() }}
            </div>
        </div>
    </div>
@endsection
