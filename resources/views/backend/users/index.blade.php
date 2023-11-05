@extends('backend.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header">{{ __('Users Management') }}</div>

        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="pull-right">
                @can('user-create')
                    <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                @endcan
            </div>

            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Verified?</th>
                    <th>Roles</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($data as $key => $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ isset($user->email_verified_at) ? 'Yes' : 'No' }}</td>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $role_name)
                                    <label class="badge-success">{{ $role_name }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Show</a>
                            @can('user-edit')
                                <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                            @endcan
                            @can('user-delete')
                                {!! html()->form('DELETE')->route('users.destroy', $user->id)->attributes(['style' => 'display:inline'])->open() !!}
                                {!! html()->button('Delete', 'submit')->class('btn btn-danger') !!}
                                {!! html()->form()->close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>

            {!! $data->render() !!}
        </div>
    </div>
@endsection
