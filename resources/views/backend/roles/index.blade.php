@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">{{ __('Create New User') }}</div>

        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="mb-3">
                @can('role-create')
                    <a class="btn btn-primary" href="{{ route('roles.create') }}">Create New Role</a>
                @endcan
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">No</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Permissions</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-normal mb-0">{{ ++$i }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-normal mb-0">{{ $role->name }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="badge {{ ($count = $role->permissions()->count()) > 0 ? 'bg-success' : 'bg-danger' }} bg-primary rounded-3 fw-semibold">{{ $count }}</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}"><i
                                            class="ti ti-eye"></i></a>
                                    @can('role-edit')
                                        <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}"><i
                                                class="ti ti-edit"></i></a>
                                    @endcan
                                    @if (!in_array($role->name, config('site.default_roles')))
                                        @can('role-delete')
                                            {{ html()->form('DELETE')->route('roles.destroy', $role->id)->attributes(['style' => 'display:inline'])->open() }}
                                            {{ html()->button('<i class="ti ti-trash"></i>', 'submit')->attributes(['onclick' => "return confirm('Are you sure?')"])->class('btn btn-danger') }}
                                            {{ html()->form()->close() }}
                                        @endcan
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                </table>
                {{ $roles->render() }}
            </div>
        </div>
    </div>
@endsection
