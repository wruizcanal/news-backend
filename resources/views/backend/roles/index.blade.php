@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">{{ __('Create New User') }}</div>

        <div class="card-body">
            <div class="pull-right">
                @can('role-create')
                    <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
                @endcan
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($roles as $key => $role)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">Show</a>
                            @can('role-edit')
                                <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                            @endcan
                            @can('role-delete')
                                {!! html()->form('DELETE')->route('roles.destroy', $role->id)->attributes(['style' => 'display:inline'])->open() !!}
                                {!! html()->button('Delete', 'submit')->class('btn btn-danger') !!}
                                {!! html()->form()->close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>

            {!! $roles->render() !!}
        </div>
    </div>
@endsection
