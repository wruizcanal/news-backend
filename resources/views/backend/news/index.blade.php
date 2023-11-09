@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">{{ __('News Management') }}</div>

        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="mb-3">
                @can('news-create')
                    <a class="btn btn-primary" href="{{ route('news.create') }}">Create New News</a>
                @endcan
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Cover</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Title</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Status</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Open</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Published Date</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Category</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $key => $new)
                            <tr>
                                <td class="border-bottom-0">
                                    <img src="{{ url($new->coverPicture->url) }}" style="height: 100px; width: 100px;">
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $new->title }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="badge {{ $new->status == App\Enums\StatusEnum::PUBLISHED->value ? 'bg-success' : 'bg-warning' }} rounded-3 fw-semibold">{{ $new->status }}</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="badge {{ $new->open_close == 1 ? 'bg-success' : 'bg-danger' }} rounded-3 fw-semibold">{{ $new->open_close == 1 ? 'Yes' : 'No' }}</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="badge bg-primary rounded-3 fw-semibold">{{ isset($new->published_date) ? $new->published_date : 'Not Set' }}</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="badge bg-primary rounded-3 fw-semibold">{{ $new->category->name }}</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <a class="btn btn-info" href="{{ route('news.show', $new->id) }}"><i
                                            class="ti ti-eye"></i></a>
                                    @can('comment-create')
                                        <a class="btn btn-primary" href="{{ route('comments.create', ['news' => $new->id]) }}"><i class="ti ti-article"></i></a>
                                    @endcan
                                    @can('news-edit')
                                        <a class="btn btn-primary" href="{{ route('news.edit', $new->id) }}"><i
                                                class="ti ti-edit"></i></a>
                                    @endcan
                                    @can('news-delete')
                                        {{ html()->form('DELETE')->route('news.destroy', $new->id)->attributes(['style' => 'display:inline'])->open() }}
                                        {{ html()->button('<i class="ti ti-trash"></i>', 'submit')->attributes(['onclick' => "return confirm('Are you sure?')"])->class('btn btn-danger') }}
                                        {{ html()->form()->close() }}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                </table>
                {{ $news->render() }}
            </div>
        </div>
    </div>
@endsection
